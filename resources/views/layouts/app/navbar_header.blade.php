<!-- Navbar Header (full width of main content area, to the right of sidebar) -->
<nav class="navbar navbar-expand-lg shadow-sm bg-white navbar-full" style="position: sticky; top: 0; z-index: 1030;">

    <div class="container-fluid px-3 px-lg-4 w-100">
        {{-- <a class="navbar-brand text-dark fw-semibold" href="{{ url('/') }}">{{ config('app.name') }}</a> --}}
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown submenu">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="languageDropdown"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ __('Translate') }}">
                    <i class="fas fa-language fa-lg text-secondary"></i>
                    <span class="d-none d-md-inline text-secondary">{{ __('Translate') }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end animated fadeIn shadow-sm" aria-labelledby="languageDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ request()->fullUrlWithQuery(['setAppLocale' => 'km']) }}">
                            <img src="{{ asset('assets/flags/cambodia.svg') }}" alt="ភាសាខ្មែរ" height="20" class="rounded" onerror="this.style.display='none'">
                            ភាសាខ្មែរ
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ request()->fullUrlWithQuery(['setAppLocale' => 'en']) }}">
                            <img src="{{ asset('assets/flags/united-kingdom.svg') }}" alt="English" height="20" class="rounded" onerror="this.style.display='none'">
                            English
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg text-secondary"></i>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        {{-- <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="{{ auth()->user()->avatar }}" alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name ?? '' }}</h4>
                                    <p class="text-muted">{{ auth()->user()->username ?? '' }}</p>
                                    <a href="{{ route('profile') }}" class="btn btn-xs btn-secondary btn-sm">{{ __('View Profile') }}</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile') }}">{{ __('My Profile') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                        </li>
                    </div> --}}
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->
