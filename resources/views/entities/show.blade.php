<?php
/**
 *
 * @var $entity \App\Models\Entity
 */
view()->share('pageTitle', $entity->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('entities.show', $entity) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $entity->id }}
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('entities.edit', $entity) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                    <i class="la la-edit"></i>
                    {{ __('Update') }}
                </a>
                <button class="btn btn-sm btn-light-danger font-weight-bold" onclick="destroyConfirmation(this)">
                    <i class="la la-trash"></i>
                    {{ __('Delete') }}
                </button>
                {!! Form::open(['route' => ['entities.destroy', $entity], 'method' => 'delete', 'class'=>"d-none", 'id' => 'delete-form']) !!}

                {!! Form::close() !!}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @include('entities.show_fields')
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