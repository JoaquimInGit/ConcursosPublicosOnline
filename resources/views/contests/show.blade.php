<?php
/**
 *
 * @var $contest \App\Models\Contest
 * @var $contestentity \App\Models\ContestEntity
 */
view()->share('pageTitle', $contest->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('contests.show', $contest) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ URL::previous() }}">
                    <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                </a>
                <h3 class="card-label">
                    {{ $contest->description }}
                </h3>
            </div>
            <div class="card-toolbar">
                @if(auth()->user()->can('accessAsUser'))
                    <a href="{{ route('contests.follow', $contest) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                        <i class="la la-start"></i>
                        @if($contestentity->follow == '0')
                            {{ __('Seguir') }}
                        @else
                            {{ __('Deixar de Seguir') }}
                        @endif
                    </a>
                @else
                <a href="{{ route('contests.edit', $contest) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                    <i class="la la-edit"></i>
                    {{ __('Update') }}
                </a>
                <button class="btn btn-sm btn-light-danger font-weight-bold" onclick="destroyConfirmation(this)">
                    <i class="la la-trash"></i>
                    {{ __('Delete') }}
                </button>
                {!! Form::open(['route' => ['contests.destroy', $contest], 'method' => 'delete', 'class'=>"d-none", 'id' => 'delete-form']) !!}

                {!! Form::close() !!}

                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @include('contests.show_fields')
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
        /*function updateRelationship(e){
                document.getElementById('updade-form').submit();
        }*/
    </script>
    <style>
        pre {
            font-family: Poppins, Helvetica, "sans-serif";
            white-space: pre-wrap;
            word-break: break-all;
            color: #7E8299 !important;
            font-weight: 500 !important;
            font-size: 13px !important;
        }
    </style>
@endpush

