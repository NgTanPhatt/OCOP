@extends('manager.layouts.app')
@section('title', 'Cập Nhật Nhập Kho')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Cập Nhật Nhập Kho</h2>
            <div>
                <a href="{{ route('manager.inventories.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="edit-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Nhập Kho</h4>
            </div>
            <div class="card-body">
                <form id="edit-form" method="POST" action="{{ route('manager.inventories.update', $inventory->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Sản phẩm</label>
                        <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                            <option value="">-- Chọn sản phẩm --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $inventory->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="quantity" min="0" value="{{ old('quantity', $inventory->quantity) }}"
                            class="form-control @error('quantity') is-invalid @enderror" placeholder="Nhập số lượng">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Thương hiệu (tuỳ chọn)</label>
                        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror">
                            <option value="">-- Không chọn --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id', $inventory->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
