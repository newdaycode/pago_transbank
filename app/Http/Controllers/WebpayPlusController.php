<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayPlusController extends Controller
{
    public function __construct(){

    	//credenciales para pasar a produccion o prueba
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function createdTransaction(Request $request)
    {

        $req = $request->except('_token');
        //crear una nueva transacción 
        $resp = (new Transaction)->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

		// La respuesta de $res a la creación del token de la transacción y la URL a la cual se redirigir al tarjetahabiente.


        //una vez creada la transacción se envia los parametros para confirmar que se esta de acuerdo con la operacion
        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitTransaction(Request $request)
    {

    	//Confirmar una transacción

    	// Una vez que el tarjetahabiente ha pagado, Webpay Plus retornará el control vía la URL que se indico en el return_url. se recibe también el parámetro token_ws que permitirá conocer el resultado de la transacción.

        $req = $request->except('_token');
        $resp = (new Transaction)->commit($req["token_ws"]);

        return view('webpayplus/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }


    public function showRefund()
    {
        return view('webpayplus/refund');
    }

    public function refundTransaction(Request $request)
    {
        $req = $request->except('_token');


        //se envia el token de la transacion a anular Esta operación permite a todo comercio habilitado, reembolsar o anular una transacción que fue generada en Webpay Plus. Puedes generar el reembolso del total o parte del monto de una transacción, dependiendo de la siguiente lógica de negocio la invocación a esta operación generará una reversa o una anulación:
        // Si el monto enviado es menor al monto total entonces se ejecutará una anulación parcial.
        // Si el monto enviado es igual al total, entonces se evaluará una anulación o reversa. Será reversa si el tiempo para ejecutarla (una hora) no ha terminado, de lo contrario se ejecutará una anulación.

        $resp = (new Transaction)->refund($req["token"], $req["amount"]);

        return view('webpayplus/refund_success', ["resp" => $resp]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];

        //se envia el token y esta operación permite obtener el estado de la transacción en los siguientes 7 días desde su creación
        $resp = (new Transaction)->status($token);

        return view('webpayplus/transaction_status', ["resp" => $resp, "req" => $req]);
    }
}
