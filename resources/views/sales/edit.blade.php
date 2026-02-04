@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('Edit Sale') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.update', $sale) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="stock_id" class="form-label">{{ __('Stock') }} <span class="text-danger">*</span></label>
                            <select name="stock_id" id="stock_id" class="form-select @error('stock_id') is-invalid @enderror" required>
                                <option value="">{{ __('Select stock') }}</option>
                                @foreach($stocks as $s)
                                    <option value="{{ $s->id }}" data-price="{{ $s->price }}" @selected(old('stock_id', $sale->stock_id) == $s->id)>{{ $s->name }} ({{ $s->code_tire }}) — {{ number_format($s->price) }}</option>
                                @endforeach
                            </select>
                            @error('stock_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">{{ __('Qty') }} <span class="text-danger">*</span></label>
                            <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $sale->qty) }}" min="1" required>
                            @error('qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('Price') }} ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $sale->price) }}" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">{{ __('Total price') }} ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="total_price" id="total_price" class="form-control bg-secondary bg-opacity-10 @error('total_price') is-invalid @enderror" value="{{ old('total_price', $sale->total) }}" min="0" required readonly>
                                @error('total_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var stockSelect = document.getElementById('stock_id');
        var priceInput = document.getElementById('price');
        var qtyInput = document.getElementById('qty');
        var totalPriceInput = document.getElementById('total_price');
        function updateTotalPrice() {
            if (qtyInput && priceInput && totalPriceInput) {
                var qty = parseFloat(qtyInput.value) || 0;
                var price = parseFloat(priceInput.value) || 0;
                totalPriceInput.value = (qty * price).toFixed(0);
            }
        }
        if (stockSelect && priceInput) {
            stockSelect.addEventListener('change', function() {
                var opt = this.options[this.selectedIndex];
                if (opt && opt.value && opt.dataset.price) {
                    priceInput.value = opt.dataset.price;
                }
                updateTotalPrice();
            });
        }
        if (qtyInput) qtyInput.addEventListener('input', updateTotalPrice);
        if (priceInput) priceInput.addEventListener('input', updateTotalPrice);
        updateTotalPrice();
    });
</script>
@endsection
