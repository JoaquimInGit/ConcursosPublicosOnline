<?php
/**
 *
 * @var $permission \App\Models\Permission
 * @var $permissions \App\Models\Permission[]
 */
view()->share('pageTitle', $permission->name);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('permissions.show', $permission) }}
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{ $permission->name }}
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                <i class="la la-edit"></i>
                {{ __('Update') }}
            </a>
            <button class="btn btn-sm btn-light-danger font-weight-bold" onclick="destroyConfirmation(this)">
                <i class="la la-trash"></i>
                {{ __('Delete') }}
            </button>

            {!! Form::open(['route' => ['permissions.destroy', $permission], 'method' => 'delete', 'class'=>"d-none", 'id' => 'delete-form']) !!}

            {!! Form::close() !!}

        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
            <tr>
                <th scope="row">{{ __('Name') }}</th>
                <td>{{ $permission->name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Guard name') }}</th>
                <td>{{ $permission->guard_name }}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Created at') }}</th>
                <td>{{$permission->created_at}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Updated at') }}</th>
                <td>{{$permission->updated_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function destroyConfirmation(e){
            swal.fire({
                title: '{{ __('Are you sure you want to delete this?') }}',
                text: "{!! __("You won't be able to revert this!") !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then(function(result) {
                if (result.value) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endpush
