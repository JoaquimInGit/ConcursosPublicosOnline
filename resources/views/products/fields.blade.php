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
    {!! Form::number('price', null, ['class' => 'form-control '.($errors->has('price') ? 'is-invalid' : '')]) !!}
    @error('price')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Reduced Price Field -->
<div class="form-group">
    {!! Form::label('reduced_price', $product->getAttributeLabel('reduced_price')) !!}
    {!! Form::number('reduced_price', null, ['class' => 'form-control '.($errors->has('reduced_price') ? 'is-invalid' : '')]) !!}
    @error('reduced_price')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
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
    {!! Form::number('status', null, ['class' => 'form-control '.($errors->has('status') ? 'is-invalid' : '')]) !!}
    @error('status')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>