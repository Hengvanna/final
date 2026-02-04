@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('CRED Stock') }}</p>
                    <h4 class="mb-0">{{ number_format($stockCount) }}</h4>
                    <small class="text-muted">{{ __('items') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('Stock quantity') }}</p>
                    <h4 class="mb-0">{{ number_format($stockTotalQty) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small mb-0">{{ __('Stock value (qty × price)') }}</p>
                    <h4 class="mb-0 text-primary">{{ number_format($stockValue) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">{{ __('Stock list') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Code Tire') }}</th>
                                    <th>{{ __('Qty') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->id }}</td>
                                        <td>{{ $stock->name }}</td>
                                        <td>{{ $stock->code_tire }}</td>
                                        <td>{{ $stock->qty }}</td>
                                        <td>{{ number_format($stock->price) }}</td>
                                        <td>{{ number_format($stock->qty * $stock->price) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">{{ __('No stocks found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($stocks->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $stocks->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
