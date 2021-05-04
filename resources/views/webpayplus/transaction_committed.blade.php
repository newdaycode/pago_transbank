@extends('layout/layout')
@section('content')
    <h1>Transacción confirmada</h1>
    <div>

        <!-- Verifica si fue aprobada o no y envia mensaje -->
        @if ($resp->isApproved())
            <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
        @else
            <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
        @endif
        <div class="response">
            <pre>{{  print_r($resp, true) }}</pre>
        </div>

        <hr class="my-5">
        <h2 class="text-lg font-bold">Obtener status de la transacción</h2>

        <form method="post" action="/webpayplus/transactionStatus">
           {{ csrf_field() }}
            <input type="hidden" value="{{ $req["token_ws"] }}" name="token">
            <button type="submit" class="btn btn-primary">Obtener status</button>
        </form>

        <h2 class="text-lg font-bold mt-10">Reembolso de la transacción</h2>
        <form method="post" action="/webpayplus/refund">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $req["token_ws"] }}" name="token"><br>
            <input type="hidden" value="{{ $resp->getAmount() }}" name="amount">
            <button type="submit" class="btn btn-primary">Obtener reembolso</button>
        </form>

    </div>
@endsection
