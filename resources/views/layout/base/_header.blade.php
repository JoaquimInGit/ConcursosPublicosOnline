{{-- Header --}}
@if(auth()->user()->can('accessAsUser'))
<div id="kt_header" class="header {{ Metronic::printClasses('header', true) }}" {{ Metronic::printAttrs('header') }}>
@else
<div id="kt_header" class="header {{ Metronic::printClasses('header', false) }}" {{ Metronic::printAttrs('header') }}>
@endif

    {{-- Container --}}
    <div class="container-fluid d-flex align-items-right justify-content-between">
        @if (config('layout.header.self.display'))

            @php
                $kt_logo_image = 'logo-light.png';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-dark.png' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo-light.png' @endphp
            @endif

            {{-- Header Menu --}}
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                @if(config('layout.aside.self.display') == false)
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img alt="Logo" src="{{ asset('media/logos/'.$kt_logo_image) }}"/>
                        </a>
                    </div>
                @endif
                    {{-- Topbar --}}
                    @if(auth()->user()->can('accessAsUser') && (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) == null))
                        <div class="align-left">
                            <a href="{{ url('/') }}">
                                <img alt="Logo" src="{{ asset('media/logos/logo-concursos-online.jpeg') }}" width="150px"/>
                            </a>
                        </div>
                    @endif
                <div id="kt_header_menu" class="header-menu header-menu-mobile {{ Metronic::printClasses('header_menu', false) }}" {{ Metronic::printAttrs('header_menu') }}>
                    <ul class="menu-nav {{ Metronic::printClasses('header_menu_nav', false) }}">
                        <?php //{{ Menu::renderHorMenu(config('menu_header.items')) }} ?>
                    </ul>
                </div>
            </div>

        @else

        @endif

        @include('layout.partials.extras._topbar')
    </div>
</div>
