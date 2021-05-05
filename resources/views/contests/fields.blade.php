<!-- Num Announcement Field -->
<div class="form-group">
    {!! Form::label('num_announcement', $contest->getAttributeLabel('num_announcement')) !!}
    {!! Form::text('num_announcement', null, ['class' => 'form-control '.($errors->has('num_announcement') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('num_announcement')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', $contest->getAttributeLabel('description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control '.($errors->has('description') ? 'is-invalid' : '')]) !!}
    @error('description')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Entity Field -->
<div class="form-group">
    {!! Form::label('entity', $contest->getAttributeLabel('entity')) !!}
    {!! Form::text('entity', null, ['class' => 'form-control '.($errors->has('entity') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('entity')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Act Field -->
<div class="form-group">
    {!! Form::label('type_act', $contest->getAttributeLabel('type_act')) !!}
    {!! Form::number('type_act', null, ['class' => 'form-control '.($errors->has('type_act') ? 'is-invalid' : '')]) !!}
    @error('type_act')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Model Field -->
<div class="form-group">
    {!! Form::label('type_model', $contest->getAttributeLabel('type_model')) !!}
    {!! Form::number('type_model', null, ['class' => 'form-control '.($errors->has('type_model') ? 'is-invalid' : '')]) !!}
    @error('type_model')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Contract Field -->
<div class="form-group">
    {!! Form::label('type_contract', $contest->getAttributeLabel('type_contract')) !!}
    {!! Form::number('type_contract', null, ['class' => 'form-control '.($errors->has('type_contract') ? 'is-invalid' : '')]) !!}
    @error('type_contract')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', $contest->getAttributeLabel('price')) !!}
    {!! Form::number('price', null, ['class' => 'form-control '.($errors->has('price') ? 'is-invalid' : '')]) !!}
    @error('price')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Publication Date Field -->
<div class="form-group">
    {!! Form::label('publication_date', $contest->getAttributeLabel('publication_date')) !!}
    <div class="input-group date">
        {!! Form::text('publication_date', null, ['class' => 'form-control kt_datepicker '.($errors->has('publication_date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
            </span>
        </div>
        @error('publication_date')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush

<!-- Deadline Field -->
<div class="form-group">
    {!! Form::label('deadline', $contest->getAttributeLabel('deadline')) !!}
    {!! Form::text('deadline', null, ['class' => 'form-control '.($errors->has('deadline') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('deadline')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', $contest->getAttributeLabel('state')) !!}
    {!! Form::number('state', null, ['class' => 'form-control '.($errors->has('state') ? 'is-invalid' : '')]) !!}
    @error('state')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Republic Diary Field -->
<div class="form-group">
    {!! Form::label('republic_diary', $contest->getAttributeLabel('republic_diary')) !!}
    {!! Form::text('republic_diary', null, ['class' => 'form-control '.($errors->has('republic_diary') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('republic_diary')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cpv Field -->
<div class="form-group">
    {!! Form::label('cpv', $contest->getAttributeLabel('cpv')) !!}
    {!! Form::text('cpv', null, ['class' => 'form-control '.($errors->has('cpv') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('cpv')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cpv Description Field -->
<div class="form-group">
    {!! Form::label('cpv_description', $contest->getAttributeLabel('cpv_description')) !!}
    {!! Form::textarea('cpv_description', null, ['class' => 'form-control '.($errors->has('cpv_description') ? 'is-invalid' : '')]) !!}
    @error('cpv_description')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Procedure Parts Field -->
<div class="form-group">
    {!! Form::label('procedure_parts', $contest->getAttributeLabel('procedure_parts')) !!}
    {!! Form::text('procedure_parts', null, ['class' => 'form-control '.($errors->has('procedure_parts') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('procedure_parts')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Pdf Content Field -->
<div class="form-group">
    {!! Form::label('pdf_content', $contest->getAttributeLabel('pdf_content')) !!}
    {!! Form::textarea('pdf_content', null, ['class' => 'form-control '.($errors->has('pdf_content') ? 'is-invalid' : '')]) !!}
    @error('pdf_content')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>