<?php
/**
 *
 * @var $contestFilter \App\Models\ContestFilter
 */
view()->share('pageTitle', $contestFilter->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('contest_filters.show', $contestFilter) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $contestFilter->id }}
                </h3>
            </div>
            <div class="card-toolbar">
            @if(auth()->user()->can('accessAsUser'))
                <!--<button class="btn btn-sm btn-light-danger font-weight-bold" onclick="updateRelationship(this)">
                        <i class="la la-trash"></i>
                        {{ __('Follow') }}
                    </button>
-->
                    <a href="{{ route('contests.follow', $contest) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                         <i class="la la-start"></i>
                        @if($contestentity->follow == '0')
                            {{ __('Seguir') }}
                        @else
                            {{ __('Deixar de Seguir') }}
                        @endif
                    </a>
                @else
            </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @include('contest_filters.show_fields')
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
