<!-- Entity Id Field -->
<div class="form-group">
    {!! Form::label('entity_id', $filter->getAttributeLabel('entity_id')) !!}
    {!! Form::number('entity_id', null, ['class' => 'form-control '.($errors->has('entity_id') ? 'is-invalid' : '')]) !!}
    @error('entity_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Filter Name Field -->
<div class="form-group">
    {!! Form::label('filter_name', $filter->getAttributeLabel('filter_name')) !!}
    {!! Form::text('filter_name', null, ['class' => 'form-control '.($errors->has('filter_name') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('filter_name')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Filter Status Field -->
<div class="form-group">
    {!! Form::label('filter_status', $filter->getAttributeLabel('filter_status')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('filter_status', 0) !!}
        {!! Form::checkbox('filter_status', '1', null) !!}
    </label>
</div>


<!-- Description Words Field -->
<div class="form-group">
    {!! Form::label('description_words', $filter->getAttributeLabel('description_words')) !!}
    {!! Form::text('description_words', null, ['class' => 'form-control '.($errors->has('description_words') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('description_words')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Contest Entity Field -->
<div class="form-group">
    {!! Form::label('contest_entity', $filter->getAttributeLabel('contest_entity')) !!}
    {!! Form::text('contest_entity', null, ['class' => 'form-control '.($errors->has('contest_entity') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('contest_entity')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Act Field -->
<div class="form-group">
    {!! Form::label('type_act', $filter->getAttributeLabel('type_act')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type_act', 0) !!}
        {!! Form::checkbox('type_act', '1', null) !!}
    </label>
</div>


<!-- Type Model Field -->
<div class="form-group">
    {!! Form::label('type_model', $filter->getAttributeLabel('type_model')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type_model', 0) !!}
        {!! Form::checkbox('type_model', '1', null) !!}
    </label>
</div>


<!-- Type Contract Field -->
<div class="form-group">
    {!! Form::label('type_contract', $filter->getAttributeLabel('type_contract')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type_contract', 0) !!}
        {!! Form::checkbox('type_contract', '1', null) !!}
    </label>
</div>


<!-- Min Price Field -->
<div class="form-group">
    {!! Form::label('min_price', $filter->getAttributeLabel('min_price')) !!}
    {!! Form::number('min_price', null, ['class' => 'form-control '.($errors->has('min_price') ? 'is-invalid' : '')]) !!}
    @error('min_price')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Max Price Field -->
<div class="form-group">
    {!! Form::label('max_price', $filter->getAttributeLabel('max_price')) !!}
    {!! Form::number('max_price', null, ['class' => 'form-control '.($errors->has('max_price') ? 'is-invalid' : '')]) !!}
    @error('max_price')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cpv Field -->
<div class="form-group">
    {!! Form::label('cpv', $filter->getAttributeLabel('cpv')) !!}
    {!! Form::text('cpv', null, ['class' => 'form-control '.($errors->has('cpv') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('cpv')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>