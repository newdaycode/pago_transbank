@extends('layout/layout')
@section('content')
    <h1> Anular operación </h1>

    <form method="post" action="refund">
         {{ csrf_field() }}
        <label for="amount">Monto de la reversa</label>
        <input id="amount" class="form-control" name="amount" value="1000">

        <label for="token">Token de operacion</label>
        <input id="token" class="form-control" name="token" value="">
        <br>
        <button type="submit" class="btn btn-primary">Enviar datos</button>

    </form>
@endsection
