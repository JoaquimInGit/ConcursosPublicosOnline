@if(auth()->user()->cannot('accessAsUser'))
<!-- Entity Id Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('entity_id') }}</th>
    <td>{{ $order->entity_id }}</td>
</tr>


<!-- User Id Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('user_id') }}</th>
    <td>{{ $order->user_id }}</td>
</tr>
@endif

<!-- Name Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('name') }}</th>
    <td>{{ $order->name }}</td>
</tr>


<!-- Email Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('email') }}</th>
    <td>{{ $order->email }}</td>
</tr>


<!-- Address Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('address') }}</th>
    <td>{{ $order->address }}</td>
</tr>


<!-- Zip Code Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('zip_code') }}</th>
    <td>{{ $order->zip_code }}</td>
</tr>


<!-- Mobile Phone Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('mobile_phone') }}</th>
    <td>{{ $order->mobile_phone }}</td>
</tr>


<!-- Nif Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('nif') }}</th>
    <td>{{ $order->nif }}</td>
</tr>


<!-- Sub Total Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('sub_total') }}</th>
    <td>{{ number_format($order->sub_total, 2, ',', '.').'€' }}</td>
</tr>


<!-- Iva Value Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('iva_value') }}</th>
    <td>{{ number_format($order->iva_value, 2, ',', '.').'€' }}</td>
</tr>


<!-- Mb Entity Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('mb_entity') }}</th>
    <td>{{ $order->mb_entity }}</td>
</tr>


<!-- Mb Ref Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('mb_ref') }}</th>
    <td>{{ $order->mb_ref }}</td>
</tr>


<!-- Mb Limit Date Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('mb_limit_date') }}</th>
    <td>{{ $order->mb_limit_date }}</td>
</tr>


<!-- Status Field -->
<tr>
    <th scope="row">{{ $order->getAttributeLabel('status') }}</th>
    <td>{{ $order->getStatusLabelAttribute() }}</td>
</tr>


