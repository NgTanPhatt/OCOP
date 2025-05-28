@extends('manager.layouts.app')
@section('title', 'Thông Tin Cá Nhân')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Thông Tin Cá Nhân</h2>
            <div>
                <a href="{{ route('manager.profile.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="update-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Cá Nhân</h4>
            </div>
            <div class="card-body">
                <form id="update-form" method="POST" action="{{ route('manager.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}"
                            class="form-control @error('fullname') is-invalid @enderror" placeholder="Nhập họ tên">
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Vai trò</label>
                        <input type="text" value="{{ ucfirst($user->role) }}" class="form-control" readonly>
                    </div>

                    <p>Đổi mật khẩu</p>
                    <hr>

                    <div class="mb-4">
                        <label class="form-label">Mật khẩu cũ</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Nhập mật khẩu cũ">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu mới">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Xác nhận mật khẩu mới">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
