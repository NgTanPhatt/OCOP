@extends('manager.layouts.app')
@section('title', 'Tạo Mã Giảm Giá')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Tạo Mã Giảm Giá</h2>
            <div>
                <a href="{{ route('manager.discounts.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="create-form" type="submit" class="btn btn-primary rounded font-sm">Tạo Mới</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Mã Giảm Giá</h4>
            </div>
            <div class="card-body">
                <form id="create-form" method="POST" action="{{ route('manager.discounts.store') }}">
                    @csrf

                    @if (Auth::user()->role == "admin")
                        <div class="mb-4">
                            <label class="form-label">Chọn Cửa Hàng</label>
                            <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror">
                                <option value="">-- Chọn cửa hàng --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('branch_id'))
                                <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                            @endif
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label">Mã giảm giá</label>
                        <input type="text" name="code" value="{{ old('code') }}"
                            class="form-control @error('code') is-invalid @enderror" placeholder="Nhập mã giảm giá">
                        @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Phần trăm giảm (%)</label>
                        <input type="number" name="percent" value="{{ old('percent') }}"
                            class="form-control @error('percent') is-invalid @enderror" placeholder="Nhập phần trăm giảm">
                        @error('percent')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ngày hết hạn</label>
                        <input type="date" name="expiration_date" value="{{ old('expiration_date') }}"
                            class="form-control @error('expiration_date') is-invalid @enderror">
                        @error('expiration_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
