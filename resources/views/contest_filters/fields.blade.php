<!-- Contest Id Field -->
<div class="form-group">
    {!! Form::label('contest_id', $contestFilter->getAttributeLabel('contest_id')) !!}
    {!! Form::number('contest_id', null, ['class' => 'form-control '.($errors->has('contest_id') ? 'is-invalid' : '')]) !!}
    @error('contest_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Filter Id Field -->
<div class="form-group">
    {!! Form::label('filter_id', $contestFilter->getAttributeLabel('filter_id')) !!}
    {!! Form::number('filter_id', null, ['class' => 'form-control '.($errors->has('filter_id') ? 'is-invalid' : '')]) !!}
    @error('filter_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', $contestFilter->getAttributeLabel('date')) !!}
    <div class="input-group date">
        {!! Form::text('date', null, ['class' => 'form-control kt_datepicker '.($errors->has('date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
            </span>
        </div>
        @error('date')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush