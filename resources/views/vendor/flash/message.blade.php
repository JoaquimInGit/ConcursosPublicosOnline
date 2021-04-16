@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @if(false)
            @include('flash::modal', [
                'modalClass' => 'flash-modal',
                'title'      => $message['title'],
                'body'       => $message['message']
            ])
        @endif
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach
@push('scripts')
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @foreach (session('flash_notification', collect())->toArray() as $message)
            @if ($message['overlay'] == true)
                @switch($message['level'])
                    @case('success')
                        toastr.success('{{ $message['message'] }}');
                    @break
                    @case('info')
                        toastr.info('{{ $message['message'] }}');
                    @break
                    @case('warning')
                        toastr.warning('{{ $message['message'] }}');
                    @break
                    @case('error')
                    @case('danger')
                        toastr.error('{{ $message['message'] }}');
                    @break
                    @default
                        toastr.success('{{ $message['message'] }}');
                @endswitch

            @endif
        @endforeach
    </script>
@endpush

{{ session()->forget('flash_notification') }}
