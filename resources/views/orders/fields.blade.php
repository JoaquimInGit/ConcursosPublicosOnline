@if(auth()->user()->can('accessAsUser'))
<!-- Entity Id Field -->
{!! Form::hidden('entity_id', $order->getEntity()->id) !!}

<!-- User Id Field -->
{!! Form::hidden('user_id', $order->getUser()->id) !!}

<!-- Name Field -->
{!! Form::hidden('name', 'Subscrição') !!}

<!-- Email Field -->
{!! Form::hidden('email', $order->getUser()->email) !!}

<!-- Address Field -->
{!! Form::hidden('address', $order->getEntity()->address) !!}

<!-- Zip Code Field -->
{!! Form::hidden('zip_code', $order->getEntity()->postal_code) !!}

<!-- Mobile Phone Field -->
{!! Form::hidden('mobile_phone', $order->getEntity()->mobile_phone) !!}

<!-- Nif Field -->
{!! Form::hidden('nif', $order->getEntity()->nif) !!}


<!-- Sub Total Field -->
{!! Form::hidden('sub_total', 0) !!}

<!-- Iva Value Field -->
{!! Form::hidden('iva_value', 0) !!}

<!-- Payment Method Field -->
{!! Form::hidden('payment_method', 0) !!}



<!-- Mb Limit Date Field -->
@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush


<!-- Payment Limit Date Field -->
@push('scripts')
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
@endpush

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <a href="{{ URL::previous() }}">
                <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
            </a>
            <h3 class="card-label">{{ __('New Subscription') }}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3">
                <div class="pt-10 pt-md-10 pb-5 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block d-block font-weight-boldest text-dark-75 py-2">10
                            <sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block d-block font-weight-bold mb-7 text-dark-50">{{__('Monthly Subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>{{__('Value w/o IVA')}}:  {{number_format($order->getSpecificPrice(0), 2, ',', '.').'€'}}</span>
                        <span>IVA 23%</span>
                        <span>{{__('Value w/IVA')}}:  {{number_format($order->getSpecificPriceIVA(0), 2, ',', '.').'€'}}</span>
                    </p>
                {!! Form::submit( __('Monthly'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-monthly'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3 border-x-0 border-x-md border-y border-y-md-0">
                <div class="pt-10 pt-md-10 pb-5 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">48
													<sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block font-weight-bold mb-7 text-dark-50">{{__('Semi-annual subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>{{__('Value w/o IVA')}}:  {{number_format($order->getSpecificPrice(1), 2, ',', '.').'€'}}</span>
                        <span>IVA 23%</span>
                        <span>{{__('Value w/IVA')}}:  {{number_format($order->getSpecificPriceIVA(1), 2, ',', '.').'€'}}</span>
                    </p>
                {!! Form::submit( __('Semi-annual'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-semiannual'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3">
                <div class="pt-10 pt-md-10 pb-5 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">84
													<sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block font-weight-bold mb-7 text-dark-50">{{__('Annual subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>{{__('Value w/o IVA')}}:  {{number_format($order->getSpecificPrice(2), 2, ',', '.').'€'}}</span>
                        <span>IVA 23%</span>
                        <span>{{__('Value w/IVA')}}:  {{number_format($order->getSpecificPrice(2), 2, ',', '.').'€'}}</span>
                    </p>
                {!! Form::submit( __('Annual'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-yearly'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
        </div>
    </div>
</div>
@else
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

    <!-- Sub Total Field -->
    <div class="form-group">
        {!! Form::label('sub_total', $order->getAttributeLabel('sub_total')) !!}
        <div class="input-group">
            {!! Form::number('sub_total', null, ['class' => 'form-control '.($errors->has('sub_total') ? 'is-invalid' : ''), 'min'=> 0, 'step' => 0.01]) !!}
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-euro"></i>
                </span>
            </div>
            @error('sub_total')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Iva Value Field -->
    <div class="form-group">
        {!! Form::label('iva_value', $order->getAttributeLabel('iva_value')) !!}
        <div class="input-group">
            {!! Form::number('iva_value', null, ['class' => 'form-control '.($errors->has('iva_value') ? 'is-invalid' : ''), 'min'=> 0, 'step' => 0.01]) !!}
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-euro"></i>
                </span>
            </div>
            @error('iva_value')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Payment Method Field -->
    {!! Form::hidden('payment_method', 0) !!}

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

    <!-- Notes Field -->
    <div class="form-group">
        {!! Form::label('notes', $order->getAttributeLabel('notes')) !!}
        {!! Form::text('notes', null, ['class' => 'form-control '.($errors->has('notes') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
        @error('notes')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Status Field -->
    <div class="form-group">
        {!! Form::label('status', $order->getAttributeLabel('status')) !!}
        {!! Form::select('status',$order->getStatusArray(), null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : ''),'placeholder' => __('Select a Status')]) !!}
        @error('status')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endif