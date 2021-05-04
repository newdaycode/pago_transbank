@extends('layout/layout')
@section('content')
<h1> Transacción creada. </h1>
<br>
<p class="-mt-4 mb-4">Ahora, con los datos recibidos se debe redirigir al usuario a webpay a la url indicada y con el token recibido</p>

<div class="request">
    <h3 class="font-bold">Request:</h3>
    <pre>{{ print_r($params, true) }}</pre>
</div>

<div class="response">
    <h3 class="font-bold">Respuesta:</h3>
    <pre>{{ print_r($response, true)  }}</pre>
</div>

<form method="get" action={{  $response->getUrl() }}>
    <input name="token_ws" type="hidden" value={{ $response->getToken() }} />

    <button type="submit" class="btn btn-primary">Enviar datos</button>
</form>

@endsection
