@if(config('layout.self.layout') == 'blank')
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
@else

    @include('layout2.base._header-mobile')

    <div class="d-flex flex-column flex-root ">

        @include('layout2.base._header')

        <div class="content {{ Metronic::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">



            @include('layout2.base._content')
        </div>

        @include('layout2.base._footer')
    </div>


@endif

@if (config('layout.self.layout') != 'blank')

    @if (config('layout.extras.search.layout') == 'offcanvas')
        @include('layout2.partials.extras.offcanvas._quick-search')
    @endif

    @if (config('layout.extras.notifications.layout') == 'offcanvas')
        @include('layout2.partials.extras.offcanvas._quick-notifications')
    @endif

    @if (config('layout.extras.quick-actions.layout') == 'offcanvas')
        @include('layout2.partials.extras.offcanvas._quick-actions')
    @endif

    @if (config('layout.extras.user.layout') == 'offcanvas')
        @include('layout2.partials.extras.offcanvas._quick-user')
    @endif

    @if (config('layout.extras.quick-panel.display'))
        @include('layout2.partials.extras.offcanvas._quick-panel')
    @endif

    @if (config('layout.extras.toolbar.display'))
        @include('layout2.partials.extras._toolbar')
    @endif

    @if (config('layout.extras.chat.display'))
        @include('layout2.partials.extras._chat')
    @endif

    @include('layout2.partials.extras._scrolltop')

@endif
