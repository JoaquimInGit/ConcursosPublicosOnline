<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', $entity->getAttributeLabel('user_id')) !!}
    {!! Form::number('user_id', null, ['class' => 'form-control '.($errors->has('user_id') ? 'is-invalid' : '')]) !!}
    @error('user_id')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Designation Field -->
<div class="form-group">
    {!! Form::label('designation', $entity->getAttributeLabel('designation')) !!}
    {!! Form::text('designation', null, ['class' => 'form-control '.($errors->has('designation') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('designation')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Country Field -->
<div class="form-group">
    {!! Form::label('country', $entity->getAttributeLabel('country')) !!}
    {!! Form::text('country', null, ['class' => 'form-control '.($errors->has('country') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('country')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- District Field -->
<div class="form-group">
    {!! Form::label('district', $entity->getAttributeLabel('district')) !!}
    {!! Form::text('district', null, ['class' => 'form-control '.($errors->has('district') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('district')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', $entity->getAttributeLabel('address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('address')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Postal Code Field -->
<div class="form-group">
    {!! Form::label('postal_code', $entity->getAttributeLabel('postal_code')) !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control '.($errors->has('postal_code') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('postal_code')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Mobile Phone Field -->
<div class="form-group">
    {!! Form::label('mobile_phone', $entity->getAttributeLabel('mobile_phone')) !!}
    {!! Form::text('mobile_phone', null, ['class' => 'form-control '.($errors->has('mobile_phone') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('mobile_phone')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Nif Field -->
<div class="form-group">
    {!! Form::label('nif', $entity->getAttributeLabel('nif')) !!}
    {!! Form::text('nif', null, ['class' => 'form-control '.($errors->has('nif') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('nif')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cae Field -->
<div class="form-group">
    {!! Form::label('cae', $entity->getAttributeLabel('cae')) !!}
    {!! Form::text('cae', null, ['class' => 'form-control '.($errors->has('cae') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('cae')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cae Secundario Field -->
<div class="form-group">
    {!! Form::label('cae_secundario', $entity->getAttributeLabel('cae_secundario')) !!}
    {!! Form::text('cae_secundario', null, ['class' => 'form-control '.($errors->has('cae_secundario') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('cae_secundario')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Website Field -->
<div class="form-group">
    {!! Form::label('website', $entity->getAttributeLabel('website')) !!}
    {!! Form::text('website', null, ['class' => 'form-control '.($errors->has('website') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('website')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Email Entity Field -->
<div class="form-group">
    {!! Form::label('email_entity', $entity->getAttributeLabel('email_entity')) !!}
    {!! Form::text('email_entity', null, ['class' => 'form-control '.($errors->has('email_entity') ? 'is-invalid' : ''),'maxlength' => 255]) !!}
    @error('email_entity')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', $entity->getAttributeLabel('state')) !!}
    {!! Form::number('state', null, ['class' => 'form-control '.($errors->has('state') ? 'is-invalid' : '')]) !!}
    @error('state')
        <div class="error invalid-feedback">{{ $message }}</div>
    @enderror
</div>