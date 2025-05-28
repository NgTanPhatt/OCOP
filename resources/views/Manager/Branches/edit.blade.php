@extends('manager.layouts.app')
@section('title', 'Sửa Cửa Hàng')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Sửa Cửa Hàng</h2>
            <div>
                <a href="{{ route('manager.branches.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="update-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Cửa Hàng</h4>
            </div>
            <div class="card-body">
                <form id="update-form" method="POST" action="{{ route('manager.branches.update', $branch->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Tên cửa hàng</label>
                        <input type="text" name="name" value="{{ old('name', $branch->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên cửa hàng">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" value="{{ old('address', $branch->address) }}"
                            class="form-control @error('address') is-invalid @enderror" placeholder="Nhập địa chỉ">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $branch->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $branch->email) }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Người Quản Lý</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">-- Chọn người dùng --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $branch->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->fullname }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
