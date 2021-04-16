<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>
    <base href="/">
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    <link href="{{ asset('css/pages/error/error-6.css') }}" rel="stylesheet" type="text/css" >

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
        <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
    @endforeach
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Error-->
        <div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url(/assets/media/error/bg6.jpg);">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-row-fluid text-center">
                <h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 12rem;">Oops...</h1>
                <p class="display-4 font-weight-bold text-white">@yield('code')</p>
                <p class="display-4 font-weight-bold text-white">@yield('message')</p>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Error-->
    </div>

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
    </script>


    {{-- Includable JS --}}
    <!--@ yield('scripts')-->
    @stack('scripts')

<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>
