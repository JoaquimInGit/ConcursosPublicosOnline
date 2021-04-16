@if (isset($breadcrumbs) && count($breadcrumbs))
    {{-- Separator --}}
    <div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>
    {{-- Breadcrumb --}}
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}" class="text-muted">
                        {{ $breadcrumb->title }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    <span class="text-muted">
                        {{ $breadcrumb->title }}
                    </span>
                </li>
            @endif
        @endforeach
    </ul>
@endif