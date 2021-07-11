<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', $product->getAttributeLabel('name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('name')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', $product->getAttributeLabel('price')) !!}
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

<!-- Reduced Price Field -->
<div class="form-group">
    {!! Form::label('reduced_price', $product->getAttributeLabel('reduced_price')) !!}
    <div class="input-group">
        {!! Form::number('reduced_price', null, ['class' => 'form-control '.($errors->has('reduced_price') ? 'is-invalid' : ''), 'min'=> 0, 'step' => 0.01]) !!}
        <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-euro"></i>
                </span>
        </div>
        @error('reduced_price')
        <div class="error invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', $product->getAttributeLabel('description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control '.($errors->has('description') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('description')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Excerpt Field -->
<div class="form-group">
    {!! Form::label('excerpt', $product->getAttributeLabel('excerpt')) !!}
    {!! Form::text('excerpt', null, ['class' => 'form-control '.($errors->has('excerpt') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('excerpt')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', $product->getAttributeLabel('status')) !!}
    {!! Form::select('status',$product->getStatusArray(), null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : ''),'placeholder' => __('Select a Status')]) !!}
    @error('status')
    <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>