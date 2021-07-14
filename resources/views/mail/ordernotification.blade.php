@component('mail::message')
# Pedido de subscrição processado

Dados para pagamento:

Entidade:   {{$order->mb_entity}}<br>
Referência: {{$order->mb_ref}}<br>
Valor:      {{$order->iva_value}}€<br>

@component('mail::button', ['url' => route('orders.show', $order->id)])
Pedido
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
