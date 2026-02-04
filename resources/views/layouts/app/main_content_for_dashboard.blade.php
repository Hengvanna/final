<div class="container mt-0">
    <div class="panel-header bg-info-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold text-uppercase text-uppercase">{{ __('Dashboard') }}</h2>
                    {{-- <h3 class="text-white op-7 mb-2">{{__('Welcome')}} {{Auth::user()->name}}
                        !!!</h3> --}}
                </div>
            </div>

        </div>
    </div>
    <div class="page-inner mt--5">
        @yield('content')
    </div>
</div>
