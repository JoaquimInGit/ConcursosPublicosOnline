<?php
/**
 *
 * @var $setting \App\Models\Setting | null
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 *
 */
?>

 {!! Form::model($setting, ['route' => Route::currentRouteName() == 'settings.create' ? ['settings.store'] : ['settings.update', $setting], 'method' => Route::currentRouteName() == 'settings.create' ? 'post' : 'put', 'class' => "form"]) !!}

    <div class="card-body">
        <div class="form-group">
            {!! Form::label('type', __('Type')) !!}
            {!! Form::select('type', \App\Models\Setting::getTypeArray() , null , ['class' => 'form-control '.($errors->has('type') ? 'is-invalid' : ''), 'required' => true]) !!}
            @error('type')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('group', __('Group')) !!}
            {!! Form::text('group', null, ['class' => 'form-control '.($errors->has('group') ? 'is-invalid' : '')]) !!}
            @error('group')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('name', __('Name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''), 'required' => true ]) !!}
            <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
            @error('name')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
            <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
        </div>
        <div class="form-group">
            {!! Form::label('slug', __('Slug')) !!}
            {!! Form::text('slug', null, ['class' => 'form-control '.($errors->has('slug') ? 'is-invalid' : ''), 'required' => true ]) !!}
            @error('slug')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('options', __('Options')) !!}
            {!! Form::text('options', null, ['class' => 'form-control '.($errors->has('options') ? 'is-invalid' : '') ]) !!}
            @error('options')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('value', __('Value')) !!}
            {!! Form::text('value', null, ['class' => 'form-control '.($errors->has('value') ? 'is-invalid' : '') ]) !!}
            @error('value')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('order', __('Order')) !!}
            {!! Form::text('order', null, ['class' => 'form-control '.($errors->has('order') ? 'is-invalid' : ''), 'type' => 'number', 'step' => 1, 'min' => 0, 'required' => true]) !!}
            @error('order')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
        <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
    </div>
{!! Form::close() !!}

<!-- example with date picker
    <div class="form-group">
        {!! Form::label('name', __('Name')) !!}
        <div class="input-group date">
            {-- Form::text('name', null, ['class' => 'form-control kt_datetimepicker '.($errors->has('name') ? 'is-invalid' : ''), 'required' => true, 'readonly' => true, 'placeholder' => __('Select date') ]) --}
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar-check-o"></i>
                </span>
            </div>
        </div>
        @error('name')
            <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
-->

@push('scripts')
    <!--
    Exemple for date and datetime pickers, use class kt_datepicker or kt_datetimepicker


    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
    -->
@endpush