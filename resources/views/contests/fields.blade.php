<!-- Base Id Field -->
<div class="form-group">
    {!! Form::label('base_id', $contest->getAttributeLabel('base_id')) !!}
    {!! Form::number('base_id', null, ['class' => 'form-control '.($errors->has('base_id') ? 'is-invalid' : '')]) !!}
    @error('base_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

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

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', $contest->getAttributeLabel('price')) !!}
    <div class="input-group">
        {!! Form::number('price', null, ['class' => 'form-control '.($errors->has('price') ? 'is-invalid' : ''), 'min'=> 0, 'step' => 0.01]) !!}
        <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-euro"></i>
                </span>
        </div>
        @error('price')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Publication Date Field -->
<div class="form-group">
    {!! Form::label('publication_date', $contest->getAttributeLabel('publication_date')) !!}
    <div class="input-group date">
        {!! Form::text('publication_date', !empty($contest->publication_date) ? $contest->publication_date->format('d-m-Y') :'', ['class' => 'form-control datepicker '.($errors->has('publication_date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
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
    <script>
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>
@endpush

<!-- Deadline Date Field -->
<div class="form-group">
    {!! Form::label('deadline_date', $contest->getAttributeLabel('deadline_date')) !!}
    <div class="input-group date">
        {!! Form::text('deadline_date', !empty($contest->deadline_date) ? $contest->deadline_date->format('d-m-Y') : '', ['class' => 'form-control datepicker '.($errors->has('deadline_date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
            </span>
        </div>
        @error('deadline_date')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>
@endpush

<!-- Proposal Time Limit Field -->
<div class="form-group">
    {!! Form::label('proposal_time_limit', $contest->getAttributeLabel('proposal_time_limit')) !!}
    {!! Form::text('proposal_time_limit', null, ['class' => 'form-control '.($errors->has('proposal_time_limit') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('proposal_time_limit')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Republic Diary Num Field -->
<div class="form-group">
    {!! Form::label('republic_diary_num', $contest->getAttributeLabel('republic_diary_num')) !!}
    {!! Form::number('republic_diary_num', null, ['class' => 'form-control '.($errors->has('republic_diary_num') ? 'is-invalid' : '')]) !!}
    @error('republic_diary_num')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Republic Diary Serie Field -->
<div class="form-group">
    {!! Form::label('republic_diary_serie', $contest->getAttributeLabel('republic_diary_serie')) !!}
    {!! Form::number('republic_diary_serie', null, ['class' => 'form-control '.($errors->has('republic_diary_serie') ? 'is-invalid' : '')]) !!}
    @error('republic_diary_serie')
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

<!-- Link Announcement Field -->
<div class="form-group">
    {!! Form::label('link_announcement', $contest->getAttributeLabel('link_announcement')) !!}
    {!! Form::text('link_announcement', null, ['class' => 'form-control '.($errors->has('link_announcement') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('link_announcement')
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

<!-- Type Act Field -->
<div class="form-group">
    {!! Form::label('type_act', $contest->getTypeActLabelAttribute()) !!}
    {!! Form::select('type_act',$contest->getTypeActArray(), null, ['class' => 'form-control '.($errors->has('type_act') ? 'is-invalid' : '')]) !!}
    @error('type_act')
    <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Model Field -->
<div class="form-group">
    {!! Form::label('type_model', $contest->getTypeModelLabelAttribute()) !!}
    {!! Form::select('type_model',$contest->getTypeModelArray(), null, ['class' => 'form-control '.($errors->has('type_model') ? 'is-invalid' : '')]) !!}
    @error('type_model')
    <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Type Contract Field -->
<div class="form-group">
    {!! Form::label('type_contract', $contest->getTypeContractLabelAttribute()) !!}
    {!! Form::select('type_contract',$contest->getTypeContractArray(), null, ['class' => 'form-control '.($errors->has('type_contract') ? 'is-invalid' : '')]) !!}
    @error('type_contract')
    <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', $contest->getAttributeLabel('status')) !!}
    {!! Form::select('status',$contest->getStatusArray(), null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : ''),'placeholder' => __('Select a Status')]) !!}
    @error('status')
    <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>
