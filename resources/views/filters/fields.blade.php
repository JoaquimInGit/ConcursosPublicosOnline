<!-- Entity Id Field -->
    {!! Form::hidden('entity_id', $filter->getEntity()) !!}

<!-- Filter Name Field -->
<div class="form-group">
    {!! Form::label('filter_name', $filter->getAttributeLabel('filter_name')) !!}
    {!! Form::text('filter_name', null, ['class' => 'form-control '.($errors->has('filter_name') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('filter_name')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Description Words Field -->
<div class="form-group">
    {!! Form::label('description_words', $filter->getAttributeLabel('description_words')) !!}
    {!! Form::text('description_words', null, ['id' => 'words', 'class' => 'tagify form-control '.($errors->has('description_words') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
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

<!-- District Field -->
<div class="form-group">
    {!! Form::label('district', $filter->getAttributeLabel('district')) !!}
    {!! Form::text('district', null, ['class' => 'form-control '.($errors->has('district') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('district')
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

<!-- Type Act Field -->
<div class="form-group">
    {!! Form::label('type_act', $filter->getAttributeLabel('type_act'),['class'=>'col-2 col-form-label']) !!}
    <div class="col-2">
        {!! Form::select('type_act',$filter->getTypeActArray(), null, ['id' => 'type_act','class' => 'form-control '.($errors->has('type_act') ? 'is-invalid' : '')]) !!}
        @error('type_act')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<!-- Type Model Field -->
<div class="form-group">
    {!! Form::label('type_model', $filter->getAttributeLabel('type_model'),['class'=>'col-2 col-form-label']) !!}
    <div class="col-2">
        {!! Form::select('type_model', $filter->getTypeModelArray(), null, ['id' => 'type_model','class' => 'form-control '.($errors->has('type_model') ? 'is-invalid' : '')]) !!}
        @error('type_model')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<!-- Type Contract Field -->
<div class="form-group">
    {!! Form::label('type_contract', $filter->getAttributeLabel('type_contract'),['class'=>'col-2 col-form-label']) !!}
    <div class="col-2">
        {!! Form::select('type_contract',$filter->getTypeContractArray(), null, ['id' => 'type_contract','class' => 'form-control '.($errors->has('type_contract') ? 'is-invalid' : '')]) !!}
        @error('type_contract')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


<!-- Filter Status Field -->
<div class="form-group">
    {!! Form::label('filter_status', $filter->getAttributeLabel('filter_status'),['class'=>'col-2 col-form-label']) !!}
    <div class="col-2">
        {!! Form::select('filter_status',$filter->getFilterStatusArray(), null, ['id' => 'filter_status','class' => 'form-control '.($errors->has('filter_status') ? 'is-invalid' : '')]) !!}
        @error('filter_status')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<!--
    {!! Form::label('filter_status', $filter->getAttributeLabel('filter_status')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('filter_status', 0) !!}
        {!! Form::checkbox('filter_status', '1', null) !!}
    </label>
-->

@push('scripts')
    <script>
        var input = document.querySelector('input[id=words]');
        new Tagify(input);

        $('#words').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endpush