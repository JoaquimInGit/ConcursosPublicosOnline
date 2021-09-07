@if (config('layout', 'extras/user/dropdown/style') == 'light')
    {{-- Header --}}
    <div class="d-flex align-items-center p-8 rounded-top">
        {{-- Symbol --}}
        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
            <img src="{{ asset('media/users/300_21.jpg') }}" alt=""/>
        </div>

        {{-- Text --}}
        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ auth()->user()->name }}</div>
        <!--<span class="label label-light-success label-lg font-weight-bold label-inline">3 messages</span>-->
    </div>
    <div class="separator separator-solid"></div>
@else
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        <div class="d-flex align-items-center mr-2">
            {{-- Symbol --}}
            <div class="symbol bg-white-o-15 mr-3">
                <span class="symbol-label text-success font-weight-bold font-size-h4">{{auth()->user()->name[0]}}</span>
            </div>

            {{-- Text --}}
            <div class="text-white m-0 flex-grow-1 mr-3 font-size-h5">{{ auth()->user()->name }}</div>
        </div>
        <!--<span class="label label-success label-lg font-weight-bold label-inline">3 messages</span>-->
    </div>
@endif

{{-- Nav --}}
<div class="navi navi-spacer-x-0 pt-5">
    {{-- Item --}}
    <a href="{{ route('users.edit', Auth::user()) }}" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-calendar-3 text-success"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    {{ __('My profile') }}
                </div>
                <div class="text-muted">
                    {{ __('Account settings and more') }}
                    <!--<span class="label label-light-danger label-inline font-weight-bold">update</span>-->
                </div>
            </div>
        </div>
    </a>
    {{-- Item --}}
    @if(auth()->user()->can('accessAsUser'))
        <a href="{{ route('entities.edit', \App\Models\Entity::getCurrentEntity()) }}"  class="navi-item px-8">
            <div class="navi-link">
                <div class="navi-icon mr-2">
                    <i class="flaticon2-mail text-warning"></i>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                        {{ __('My Entity') }}
                    </div>
                    <div class="text-muted">
                        {{ __('Entity information') }}
                    </div>
                </div>
            </div>
        </a>
        {{-- Item --}}
        <a href="{{ route('orders.index') }}"  class="navi-item px-8">
            <div class="navi-link">
                <div class="navi-icon mr-2">
                    <i class="flaticon2-rocket-1 text-danger"></i>
                </div>
                <div class="navi-text">
                    <div class="font-weight-bold">
                        {{ __('My Orders') }}
                    </div>
                    <div class="text-muted">
                        {{ __('Orders information') }}
                    </div>
                </div>
            </div>
        </a>
    @endif
    {{-- Item --}}
    <!--<a href="#" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-hourglass text-primary"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    My Tasks
                </div>
                <div class="text-muted">
                    latest tasks and projects
                </div>
            </div>
        </div>
    </a>-->

    {{-- Footer --}}
    <div class="navi-separator mt-3"></div>
    <div class="navi-footer  px-8 py-5">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-light-primary font-weight-bold">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @impersonating
            <a href="{{ route('impersonate.leave') }}" class="btn btn-clean font-weight-bold">{{ __('Leave impersonation') }}</a>
        @endImpersonating
    </div>
</div>
