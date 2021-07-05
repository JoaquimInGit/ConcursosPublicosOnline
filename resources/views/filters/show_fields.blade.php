<!-- Entity Id Field -->
@if(auth()->user()->cannot('accessAsUser'))
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('entity_id') }}</th>
    <td>{{ $filter->entity_id }}</td>
</tr>
@endif


<!-- Filter Name Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('filter_name') }}</th>
    <td>{{ $filter->filter_name }}</td>
</tr>


<!-- Description Words Field -->
<tr>

    <th scope="row">{{ $filter->getAttributeLabel('description_words') }}</th>
    <td>{{ $filter->getWordsLabelAttribute() }}</td>
</tr>


<!-- Contest Entity Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('contest_entity') }}</th>
    <td>{{ $filter->contest_entity }}</td>
</tr>


<!-- District Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('district') }}</th>
    <td>{{ $filter->district }}</td>
</tr>


<!-- Min Price Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('min_price') }}</th>
    <td>{{ $filter->min_price }}</td>
</tr>


<!-- Max Price Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('max_price') }}</th>
    <td>{{ $filter->max_price }}</td>
</tr>


<!-- Cpv Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('cpv') }}</th>
    <td>{{ $filter->cpv }}</td>
</tr>


<!-- Type Act Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('type_act') }}</th>
    <td>{{ $filter->getTypeActLabelAttribute() }}</td>
</tr>


<!-- Type Model Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('type_model') }}</th>
    <td>{{ $filter->getTypeModelLabelAttribute() }}</td>
</tr>


<!-- Type Contract Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('type_contract') }}</th>
    <td>{{ $filter->getTypeContractLabelAttribute() }}</td>
</tr>


<!-- Filter Status Field -->
<tr>
    <th scope="row">{{ $filter->getAttributeLabel('filter_status') }}</th>
    <td>{{ $filter->getFilterStatusLabelAttribute() }}</td>
</tr>


