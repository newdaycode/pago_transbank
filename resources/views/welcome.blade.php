@extends('layout/layout')
@section('content')

    <h1>Transbank Webpay Plus</h1>

    <form class="webpay_form" action="create" method="post">
        {{ csrf_field() }}
        <label for="buy_order">
            Orden de compra
        </label>
        <input id="buy_order" readonly="" class="form-control" name="buy_order" value="123456"/>

        <label for="session_id">
            Id de sesión
        </label>
        <input id="session_id" readonly="" class="form-control" name="session_id" value="session123456" />

        <label for="amount">
            Monto
        </label>
        <input id="amount"  class="form-control" name="amount" value="1000"/>


        <label for="return_url">
            URL de retorno
        </label>
        <input id="return_url" readonly="" class="form-control" name="return_url" value="{{ url('/') }}/webpayplus/returnUrl"/>
        <br>
        <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
@endsection
