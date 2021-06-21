<!-- Entity Id Field -->
{!! Form::hidden('entity_id', $order->getEntity()->id) !!}

<!-- User Id Field -->
{!! Form::hidden('user_id', $order->getUser()->id) !!}

<!-- Name Field -->
{!! Form::hidden('name', $order->getUser()->name) !!}

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
{!! Form::hidden('sub_total', $order->getSpecificPrice(0)) !!}

<!-- Iva Value Field -->
{!! Form::hidden('iva_value', $order->getSpecificPriceIVA(0)) !!}

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
                <span class="card-icon">
                    <i class="flaticon2-chart text-primary"></i>
                </span>
            <h3 class="card-label">{{ __('New Subscription') }}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center my-20">
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3">
                <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block d-block font-weight-boldest text-dark-75 py-2">10
                            <sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block d-block font-weight-bold mb-7 text-dark-50">{{__('Monthly Subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>Valor s/IVA:  {{$order->getSpecificPrice(0)}}€</span>
                        <span>IVA 23%</span>
                        <span>Valor c/IVA:  {{$order->getSpecificPriceIVA(0)}}€</span>
                    </p>
                {!! Form::submit( __('Monthly'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-monthly'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3 border-x-0 border-x-md border-y border-y-md-0">
                <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">48
													<sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block font-weight-bold mb-7 text-dark-50">{{__('Semi-annual subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>Valor s/IVA:  {{$order->getSpecificPrice(1)}}€</span>
                        <span>IVA 23%</span>
                        <span>Valor c/IVA:  {{$order->getSpecificPriceIVA(1)}}€</span>
                    </p>
                {!! Form::submit( __('Semi-annual'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-semiannual'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
            <!--begin: Pricing-->
            <div class="col-md-4 col-xxl-3">
                <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                    <!--begin::Content-->
                    <span class="font-size-h1 d-block font-weight-boldest text-dark-75 py-2">84
													<sup class="font-size-h3 font-weight-normal pl-1">€</sup></span>
                    <h4 class="font-size-h6 d-block font-weight-bold mb-7 text-dark-50">{{__('Annual subscription')}}</h4>
                    <p class="mb-15 d-flex flex-column">
                        <span>Valor s/IVA:  {{$order->getSpecificPrice(2)}}€</span>
                        <span>IVA 23%</span>
                        <span>Valor c/IVA:  {{$order->getSpecificPriceIVA(2)}}€</span>
                    </p>
                {!! Form::submit( __('Annual'), ['class' => 'btn btn-primary text-uppercase font-weight-bolder px-15 py-3', 'name' => 'submit', 'value' => 'save-yearly'])!!}
                    <!--end::Content-->
                </div>
            </div>
            <!--end: Pricing-->
        </div>
    </div>
</div>


