<?php
/**
 *
 * @var $setting \App\Models\Setting
 */
view()->share('pageTitle', $setting->name);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.show', $setting) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $setting->name }}
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('settings.edit', $setting) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                    <i class="la la-edit"></i>
                    {{ __('Update') }}
                </a>
                <button class="btn btn-sm btn-light-danger font-weight-bold" onclick="destroyConfirmation(this)">
                    <i class="la la-trash"></i>
                    {{ __('Delete') }}
                </button>

                {!! Form::open(['route' => ['settings.destroy', $setting], 'method' => 'delete', 'class'=>"d-none", 'id' => 'delete-form']) !!}

                {!! Form::close() !!}

            </div>
        </div>
        <div class="card-body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped">
                        <tbody>
                        <!--//Column::make('id'),
                        Column::make('type'),
                        Column::make('group'),
                        Column::make('name'),
                        //Column::make('slug'),
                        //Column::make('options'),
                        Column::make('value'),
                        //Column::make('order'),
                        //Column::make('created_at'),
                        //Column::make('updated_at'),-->
                            <tr>
                                <th scope="row">{{ __('ID') }}</th>
                                <td>{{ $setting->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Type') }}</th>
                                <td>{{ $setting->typeLabel }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Group') }}</th>
                                <td>{{ $setting->group }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ $setting->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Slug') }}</th>
                                <td>{{ $setting->slug }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Options') }}</th>
                                <td>{{ $setting->options }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Value') }}</th>
                                <td>{{ $setting->value }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created at') }}</th>
                                <td>{{$setting->created_at}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated at') }}</th>
                                <td>{{$setting->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Section-->

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
