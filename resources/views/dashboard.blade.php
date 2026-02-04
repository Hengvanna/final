@extends('layouts.app')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('stocks.index') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-boxes fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1">{{ __('Stock') }}</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($totalStocks ?? 0) }}</h4>
                            <small class="text-muted">{{ __('Total items') }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('categories.index') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-folder fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1">{{ __('Categories') }}</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($totalCategories ?? 0) }}</h4>
                            <small class="text-muted">{{ __('Total categories') }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('sales.index') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-shopping-cart fa-2x text-info"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1">{{ __('Sales') }}</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($totalSales ?? 0) }}</h4>
                            <small class="text-muted">{{ __('Transactions') }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="{{ route('reports.sale') }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 card-hover">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1">{{ __('Revenue') }}</h6>
                            <h4 class="mb-0 fw-bold">${{ number_format($totalRevenue ?? 0) }}</h4>
                            <small class="text-muted">{{ __('Total sales') }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt text-warning me-2"></i>{{ __('Quick Actions') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('stocks.index') }}" class="btn btn-outline-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-boxes"></i>
                                <span>{{ __('Manage Stock') }}</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('stocks.create') }}" class="btn btn-outline-success w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-plus"></i>
                                <span>{{ __('Add Tire') }}</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('sales.create') }}" class="btn btn-outline-info w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>{{ __('New Sale') }}</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('reports.stock') }}" class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fas fa-chart-line"></i>
                                <span>{{ __('Report Stock') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endsection
