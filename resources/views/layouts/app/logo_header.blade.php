<!-- Logo Header -->
<div class="logo-header" data-background-color="white">
    <a href="{{ url('/') }}" class="logo text-decoration-none d-flex align-items-center">
        @if(file_exists(public_path('assets/logo/IDG/Navy/CADT-IDG-Logos-Navy_CADT-IDG-Lockup-1-Khmer-English.png')))
            <img src="{{ asset('assets/logo/IDG/Navy/CADT-IDG-Logos-Navy_CADT-IDG-Lockup-1-Khmer-English.png') }}" width="150" height="40" alt="{{ config('app.name') }}" class="logo-img">
        @else
            <span class="logo-text fw-bold text-dark">{{ config('app.name') }}</span>
        @endif
    </a>
    <div class="logo-header-actions d-flex align-items-center gap-1">
        <button class="btn btn-link btn-sm text-dark p-1" type="button" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <button class="btn btn-link btn-sm text-dark p-1" type="button" aria-label="More">
            <i class="fas fa-ellipsis-v"></i>
        </button>
    </div>
</div>
<!-- End Logo Header -->
