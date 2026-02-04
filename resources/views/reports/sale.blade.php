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
                            <a href="{{ route('reports.sale') }}" class="btn btn-outline-secondary btn-sm">{{ __('Clear') }}</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('Transactions') }}</p>
                    <h4 class="mb-0">{{ number_format($saleCount) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('Sales revenue') }}</p>
                    <h4 class="mb-0 text-success">{{ number_format($saleTotalRevenue) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('Units sold') }}</p>
                    <h4 class="mb-0">{{ number_format($saleTotalQty) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">{{ __('Sales list') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Stock') }}</th>
                                    <th>{{ __('Qty') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->stock?->name ?? '—' }} <small class="text-muted">({{ $sale->stock?->code_tire ?? '—' }})</small></td>
                                        <td>{{ $sale->qty }}</td>
                                        <td>{{ number_format($sale->price) }}</td>
                                        <td>{{ number_format($sale->total) }}</td>
                                        <td>{{ $sale->sale_date ? $sale->sale_date->format('Y-m-d') : '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">{{ __('No sales in this period.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($sales->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $sales->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
