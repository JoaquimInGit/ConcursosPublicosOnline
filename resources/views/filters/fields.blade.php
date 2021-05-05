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

<!-- Filter State Field -->
<div class="form-group">
    {!! Form::label('filter_state', $filter->getAttributeLabel('filter_state')) !!}
    {!! Form::number('filter_state', null, ['class' => 'form-control '.($errors->has('filter_state') ? 'is-invalid' : '')]) !!}
    @error('filter_state')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
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
    {!! Form::number('type_act', null, ['class' => 'form-control '.($errors->has('type_act') ? 'is-invalid' : '')]) !!}
    @error('type_act')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Model Field -->
<div class="form-group">
    {!! Form::label('type_model', $filter->getAttributeLabel('type_model')) !!}
    {!! Form::number('type_model', null, ['class' => 'form-control '.($errors->has('type_model') ? 'is-invalid' : '')]) !!}
    @error('type_model')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Contract Field -->
<div class="form-group">
    {!! Form::label('type_contract', $filter->getAttributeLabel('type_contract')) !!}
    {!! Form::number('type_contract', null, ['class' => 'form-control '.($errors->has('type_contract') ? 'is-invalid' : '')]) !!}
    @error('type_contract')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
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