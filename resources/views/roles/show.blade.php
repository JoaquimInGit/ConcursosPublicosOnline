<?php
/**
 *
 * @var $role \App\Models\Role
 * @var $permissions \App\Models\Permission[]
 */
view()->share('pageTitle', $role->name);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('roles.show', $role) }}
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{ $role->name }}
            </h3>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
            <tr>
                <th scope="row">{{ __('Name') }}</th>
                <td>{{ $role->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Guard name') }}</th>
                <td>{{ $role->guard_name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Created at') }}</th>
                <td>{{$role->created_at}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Updated at') }}</th>
                <td>{{$role->updated_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{ __('Permissions') }}
            </h3>
        </div>
    </div>
    <form class="form" method="POST" action="{{route('roles.update_permissions', $role)}}">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                    $per_found = null;

                    if( isset($role) ) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    /*if( isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }*/
                    ?>
                    <div class="col-md-3">
                        <!--<div class="checkbox">
                            <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>-->

                        <span class="switch">
                            <label>
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!}
                                <span></span>
                                <label class="inline-label">{{ $perm->name }}</label>
                            </label>
                        </span>


                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
            <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
        </div>
    </form>
</div>
@endsection
