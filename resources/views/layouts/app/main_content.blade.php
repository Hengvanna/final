<div class="container mt-0">
    <div class="page-inner">
        <div class="d-flex">
            <div class="page-header">
                {{-- <h4 class="page-title">{{ $title ?? '' }}</h4> --}}
                @if(!empty($maps))
                    {{-- <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        @foreach($maps as $name => $url)
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{ $loop->last ? '#' : $url }}" class="text-decoration-none">{{ $name }}</a>
                            </li>
                        @endforeach
                    </ul> --}}
                @endif
            </div>
            <div class="ms-auto">
                @yield('panel-header-right-side')
            </div>
        </div>
        <div class="page-category">
            @yield('content')
        </div>
    </div>
</div>
