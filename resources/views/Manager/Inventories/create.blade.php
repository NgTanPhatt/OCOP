@extends('manager.layouts.app')
@section('title', 'Nhập Kho')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Nhập Kho Sản Phẩm</h2>
            <div>
                <a href="{{ route('manager.inventories.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="create-form" type="submit" class="btn btn-primary rounded font-sm">Tạo Mới</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Nhập Kho</h4>
            </div>
            <div class="card-body">
                <form id="create-form" method="POST" action="{{ route('manager.inventories.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Sản phẩm</label>
                        <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                            <option value="">-- Chọn sản phẩm --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
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
                        <input type="number" name="quantity" min="0" value="{{ old('quantity') }}"
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
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
