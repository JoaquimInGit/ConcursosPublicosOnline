@component('mail::message')
# A sua subscrição expirou à 7 dias

Já perdeu {{$contestsCount}} anúncios.<br>
Para renovar a sua subscrição proceda ao seu pagamento:<br>
Entidade : {{$item->order->mb_ent}}<br>
Referência : {{$item->order->mb_ref}}<br>
Total : {{$item->order->iva}}<br>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
