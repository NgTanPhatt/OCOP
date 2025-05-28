@extends('manager.layouts.app')
@section('title', 'Cấu Hình Chi Nhánh')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Cấu Hình Chi Nhánh</h2>
            <button form="branch-config-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Chi Nhánh</h4>
            </div>
            <div class="card-body">
                <form id="branch-config-form" method="POST" action="{{ route('manager.config.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Tên chi nhánh</label>
                        <input type="text" name="name" value="{{ old('name', $branch->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên chi nhánh">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ảnh đại diện cửa hàng</label>
                        @if(!empty($branch->avatar))
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$branch->avatar) }}" alt="Avatar" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Địa chỉ</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2"
                            placeholder="Nhập địa chỉ">{{ old('address', $branch->address ?? '') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $branch->phone ?? '') }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $branch->email ?? '') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email chi nhánh">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
