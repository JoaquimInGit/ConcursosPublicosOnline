<!-- Base Id Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('base_id') }}</th>
    <td>{{ $contest->base_id }}</td>
</tr>


<!-- Num Announcement Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('num_announcement') }}</th>
    <td>{{ $contest->num_announcement }}</td>
</tr>


<!-- Description Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('description') }}</th>
    <td>{{ $contest->description }}</td>
</tr>


<!-- Entity Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('entity') }}</th>
    <td>{{ $contest->entity }}</td>
</tr>


<!-- Price Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('price') }}</th>
    <td>{{ $contest->price }}</td>
</tr>


<!-- Publication Date Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('publication_date') }}</th>
    <td>{{ $contest->publication_date }}</td>
</tr>


<!-- Deadline Date Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('deadline_date') }}</th>
    <td>{{ $contest->deadline_date }}</td>
</tr>


<!-- Proposal Time Limit Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('proposal_time_limit') }}</th>
    <td>{{ $contest->proposal_time_limit }}</td>
</tr>


<!-- Republic Diary Num Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('republic_diary_num') }}</th>
    <td>{{ $contest->republic_diary_num }}</td>
</tr>


<!-- Republic Diary Serie Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('republic_diary_serie') }}</th>
    <td>{{ $contest->republic_diary_serie }}</td>
</tr>


<!-- Cpv Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('cpv') }}</th>
    <td>{{ $contest->cpv }}</td>
</tr>


<!-- Cpv Description Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('cpv_description') }}</th>
    <td>{{ $contest->cpv_description }}</td>
</tr>


<!-- Procedure Parts Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('procedure_parts') }}</th>
    <td>{{ $contest->procedure_parts }}</td>
</tr>


<!-- Link Announcement Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('link_announcement') }}</th>
    <td>{{ $contest->link_announcement }}</td>
</tr>


<!-- Pdf Content Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('pdf_content') }}</th>
    <td>{{ $contest->pdf_content }}</td>
</tr>


<!-- Type Act Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('type_act') }}</th>
    <td>{{ $contest->getTypeActLabelAttribute() }}</td>
</tr>


<!-- Type Model Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('type_model') }}</th>
    <td>{{ $contest->getTypeModelLabelAttribute() }}</td>
</tr>


<!-- Type Contract Field -->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('type_contract') }}</th>
    <td>{{ $contest->getTypeContractLabelAttribute() }}</td>
</tr>


<!-- Status Field -->
<!--<tr>
    <th scope="row">{{ $contest->getAttributeLabel('status') }}</th>
    <td>{{ $contest->status }}</td>
</tr>-->
<tr>
    <th scope="row">{{ $contest->getAttributeLabel('status') }}</th>
    <td>{{ $contest->getStatusLabelAttribute() }}</td>
</tr>


