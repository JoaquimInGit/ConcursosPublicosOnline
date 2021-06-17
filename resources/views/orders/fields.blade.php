<!-- Entity Id Field -->
<div class="form-group">
    {!! Form::label('entity_id', $order->getAttributeLabel('entity_id')) !!}
    {!! Form::number('entity_id', null, ['class' => 'form-control '.($errors->has('entity_id') ? 'is-invalid' : '')]) !!}
    @error('entity_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', $order->getAttributeLabel('user_id')) !!}
    {!! Form::number('user_id', null, ['class' => 'form-control '.($errors->has('user_id') ? 'is-invalid' : '')]) !!}
    @error('user_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', $order->getAttributeLabel('name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('name')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', $order->getAttributeLabel('email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control '.($errors->has('email') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('email')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', $order->getAttributeLabel('address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('address')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Zip Code Field -->
<div class="form-group">
    {!! Form::label('zip_code', $order->getAttributeLabel('zip_code')) !!}
    {!! Form::text('zip_code', null, ['class' => 'form-control '.($errors->has('zip_code') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('zip_code')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mobile Phone Field -->
<div class="form-group">
    {!! Form::label('mobile_phone', $order->getAttributeLabel('mobile_phone')) !!}
    {!! Form::text('mobile_phone', null, ['class' => 'form-control '.($errors->has('mobile_phone') ? 'is-invalid' : ''),'maxlength' => 32]) !!}
    @error('mobile_phone')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Nif Field -->
<div class="form-group">
    {!! Form::label('nif', $order->getAttributeLabel('nif')) !!}
    {!! Form::text('nif', null, ['class' => 'form-control '.($errors->has('nif') ? 'is-invalid' : ''),'maxlength' => 32]) !!}
    @error('nif')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Coupon Field -->
<div class="form-group">
    {!! Form::label('coupon', $order->getAttributeLabel('coupon')) !!}
    {!! Form::text('coupon', null, ['class' => 'form-control '.($errors->has('coupon') ? 'is-invalid' : ''),'maxlength' => 64]) !!}
    @error('coupon')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Discount Field -->
<div class="form-group">
    {!! Form::label('discount', $order->getAttributeLabel('discount')) !!}
    {!! Form::number('discount', null, ['class' => 'form-control '.($errors->has('discount') ? 'is-invalid' : '')]) !!}
    @error('discount')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Sub Total Field -->
<div class="form-group">
    {!! Form::label('sub_total', $order->getAttributeLabel('sub_total')) !!}
    {!! Form::number('sub_total', null, ['class' => 'form-control '.($errors->has('sub_total') ? 'is-invalid' : '')]) !!}
    @error('sub_total')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Iva Value Field -->
<div class="form-group">
    {!! Form::label('iva_value', $order->getAttributeLabel('iva_value')) !!}
    {!! Form::number('iva_value', null, ['class' => 'form-control '.($errors->has('iva_value') ? 'is-invalid' : '')]) !!}
    @error('iva_value')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Payment Method Field -->
<div class="form-group">
    {!! Form::label('payment_method', $order->getAttributeLabel('payment_method')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('payment_method', 0) !!}
        {!! Form::checkbox('payment_method', '1', null) !!}
    </label>
</div>


<!-- Notes Field -->
<div class="form-group">
    {!! Form::label('notes', $order->getAttributeLabel('notes')) !!}
    {!! Form::text('notes', null, ['class' => 'form-control '.($errors->has('notes') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('notes')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mb Entity Field -->
<div class="form-group">
    {!! Form::label('mb_entity', $order->getAttributeLabel('mb_entity')) !!}
    {!! Form::text('mb_entity', null, ['class' => 'form-control '.($errors->has('mb_entity') ? 'is-invalid' : ''),'maxlength' => 5]) !!}
    @error('mb_entity')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mb Ref Field -->
<div class="form-group">
    {!! Form::label('mb_ref', $order->getAttributeLabel('mb_ref')) !!}
    {!! Form::text('mb_ref', null, ['class' => 'form-control '.($errors->has('mb_ref') ? 'is-invalid' : ''),'maxlength' => 9]) !!}
    @error('mb_ref')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mb Limit Date Field -->
<div class="form-group">
    {!! Form::label('mb_limit_date', $order->getAttributeLabel('mb_limit_date')) !!}
    <div class="input-group date">
        {!! Form::text('mb_limit_date', null, ['class' => 'form-control kt_datepicker '.($errors->has('mb_limit_date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
            </span>
        </div>
        @error('mb_limit_date')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush

<!-- Mbway Ref Field -->
<div class="form-group">
    {!! Form::label('mbway_ref', $order->getAttributeLabel('mbway_ref')) !!}
    {!! Form::text('mbway_ref', null, ['class' => 'form-control '.($errors->has('mbway_ref') ? 'is-invalid' : ''),'maxlength' => 25]) !!}
    @error('mbway_ref')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mbway Alias Field -->
<div class="form-group">
    {!! Form::label('mbway_alias', $order->getAttributeLabel('mbway_alias')) !!}
    {!! Form::text('mbway_alias', null, ['class' => 'form-control '.($errors->has('mbway_alias') ? 'is-invalid' : ''),'maxlength' => 32]) !!}
    @error('mbway_alias')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Payment Ref Field -->
<div class="form-group">
    {!! Form::label('payment_ref', $order->getAttributeLabel('payment_ref')) !!}
    {!! Form::text('payment_ref', null, ['class' => 'form-control '.($errors->has('payment_ref') ? 'is-invalid' : ''),'maxlength' => 64]) !!}
    @error('payment_ref')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Invoice Id Field -->
<div class="form-group">
    {!! Form::label('invoice_id', $order->getAttributeLabel('invoice_id')) !!}
    {!! Form::text('invoice_id', null, ['class' => 'form-control '.($errors->has('invoice_id') ? 'is-invalid' : ''),'maxlength' => 64]) !!}
    @error('invoice_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Invoice Link Field -->
<div class="form-group">
    {!! Form::label('invoice_link', $order->getAttributeLabel('invoice_link')) !!}
    {!! Form::text('invoice_link', null, ['class' => 'form-control '.($errors->has('invoice_link') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('invoice_link')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Payment Limit Date Field -->
<div class="form-group">
    {!! Form::label('payment_limit_date', $order->getAttributeLabel('payment_limit_date')) !!}
    <div class="input-group date">
        {!! Form::text('payment_limit_date', null, ['class' => 'form-control kt_datepicker '.($errors->has('payment_limit_date') ? 'is-invalid' : ''), 'readonly' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="la la-calendar-check-o"></i>
            </span>
        </div>
        @error('payment_limit_date')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush

<!-- Invoice Status Field -->
<div class="form-group">
    {!! Form::label('invoice_status', $order->getAttributeLabel('invoice_status')) !!}
    {!! Form::number('invoice_status', null, ['class' => 'form-control '.($errors->has('invoice_status') ? 'is-invalid' : '')]) !!}
    @error('invoice_status')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', $order->getAttributeLabel('status')) !!}
    {!! Form::number('status', null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : '')]) !!}
    @error('status')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>