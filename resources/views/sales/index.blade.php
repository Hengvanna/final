@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h5 class="card-title mb-0">{{ __('CRED Sales') }}</h5>
                    <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> {{ __('Add Sale') }}
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="GET" class="mb-3">
                        <div class="row g-2 align-items-end flex-wrap">
                            <div class="col-auto">
                                <label for="stock_id" class="form-label small mb-0">{{ __('Stock') }}</label>
                                <select name="stock_id" id="stock_id" class="form-select form-select-sm" style="min-width: 180px;">
                                    <option value="">{{ __('All stocks') }}</option>
                                    @foreach($stocks as $s)
                                        <option value="{{ $s->id }}" {{ (string) request('stock_id') === (string) $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->code_tire }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="search" class="form-label small mb-0 d-block">&nbsp;</label>
                                <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="{{ __('Search by stock name or code...') }}" value="{{ request('search') }}" style="min-width: 200px;">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search me-1"></i>{{ __('Search') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Stock') }}</th>
                                    <th>{{ __('Qty') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th class="text-end">{{ __('Actions') }}</th>
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
                                        <td class="text-end">
                                            <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-outline-primary" title="{{ __('Edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this sale?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('Delete') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">{{ __('No sales found.') }}</td>
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
