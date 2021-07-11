<!-- Name Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('name') }}</th>
    <td>{{ $product->name }}</td>
</tr>


<!-- Price Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('price') }}</th>
    <td>{{ !empty($product->price) ? $product->price.'€' : '' }}</td>
</tr>


<!-- Reduced Price Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('reduced_price') }}</th>
    <td>{{ !empty($product->reduced_price) ? $product->reduced_price.'€' : '' }}</td>
</tr>


<!-- Description Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('description') }}</th>
    <td>{{ $product->description }}</td>
</tr>


<!-- Excerpt Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('excerpt') }}</th>
    <td>{{ $product->excerpt }}</td>
</tr>


<!-- Status Field -->
<tr>
    <th scope="row">{{ $product->getAttributeLabel('status') }}</th>
    <td>{{ $product->getStatusLabelAttribute() }}</td>
</tr>


