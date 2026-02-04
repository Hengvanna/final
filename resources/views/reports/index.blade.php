@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form method="GET" class="mb-3">
                <div class="row g-2 align-items-end flex-wrap">
                    <div class="col-auto">
                        <label for="date_from" class="form-label small mb-0">{{ __('From date') }}</label>
                        <input type="date" name="date_from" id="date_from" class="form-control form-control-sm" value="{{ $dateFrom }}" style="min-width: 140px;">
                    </div>
                    <div class="col-auto">
                        <label for="date_to" class="form-label small mb-0">{{ __('To date') }}</label>
                        <input type="date" name="date_to" id="date_to" class="form-control form-control-sm" value="{{ $dateTo }}" style="min-width: 140px;">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-filter me-1"></i>{{ __('Filter') }}</button>
                        @if($dateFrom || $dateTo)
                            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('Clear') }}</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-boxes text-primary"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">{{ __('CRED Stock') }}</p>
                            <h5 class="mb-0">{{ number_format($stockCount) }}</h5>
                            <small class="text-muted">{{ __('items') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-layer-group text-info"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">{{ __('Stock quantity') }}</p>
                            <h5 class="mb-0">{{ number_format($stockTotalQty) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-shopping-cart text-success"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">{{ __('CRED Sales') }}</p>
                            <h5 class="mb-0">{{ number_format($saleCount) }}</h5>
                            <small class="text-muted">{{ __('transactions') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-coins text-warning"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">{{ __('Sales revenue') }}</p>
                            <h5 class="mb-0">{{ number_format($saleTotalRevenue) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">{{ __('Stock value (qty × price)') }}</h5>
                </div>
                <div class="card-body">
                    <h4 class="text-primary">{{ number_format($stockValue) }}</h4>
                    <p class="text-muted small mb-0">{{ __('Total value of current stock.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">{{ __('Units sold') }}</h5>
                </div>
                <div class="card-body">
                    <h4 class="text-success">{{ number_format($saleTotalQty) }}</h4>
                    <p class="text-muted small mb-0">{{ __('Total quantity sold in selected period.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('Recent sales') }}</h5>
                    <a href="{{ route('sales.index') }}" class="btn btn-outline-primary btn-sm">{{ __('View all') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Stock') }}</th>
                                    <th>{{ __('Qty') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->stock?->name ?? '—' }} <small class="text-muted">({{ $sale->stock?->code_tire ?? '—' }})</small></td>
                                        <td>{{ $sale->qty }}</td>
                                        <td>{{ number_format($sale->total) }}</td>
                                        <td>{{ $sale->sale_date ? $sale->sale_date->format('Y-m-d') : '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">{{ __('No sales in this period.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
