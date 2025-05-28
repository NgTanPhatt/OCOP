@extends('manager.layouts.app')
@section('title', 'Sửa Người Dùng')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Sửa Người Dùng</h2>
            <div>
                <a href="{{ route('manager.users.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="edit-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Người Dùng</h4>
            </div>
            <div class="card-body">
                <form id="edit-form" method="POST" action="{{ route('manager.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Họ Tên</label>
                        <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" class="form-control @error('fullname') is-invalid @enderror" placeholder="Nhập họ tên">
                        @error('fullname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tên Đăng Nhập</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control @error('username') is-invalid @enderror" placeholder="Nhập tên đăng nhập">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Vai Trò</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" id="branch-select" style="display: {{ old('role', $user->role) == 'manager' ? 'block' : 'none' }};">
                        <label class="form-label">Chọn Cửa Hàng</label>
                        <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror">
                            <option value="">-- Chọn cửa hàng --</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Xác nhận mật khẩu">
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Hiển thị chọn cửa hàng nếu người dùng chọn vai trò là manager
    document.querySelector('select[name="role"]').addEventListener('change', function() {
        var branchSelect = document.getElementById('branch-select');
        if (this.value === 'manager') {
            branchSelect.style.display = 'block';
        } else {
            branchSelect.style.display = 'none';
        }
    });

    // Mặc định hiển thị/ẩn nếu có giá trị trong old('role') hoặc người dùng đã có giá trị trong DB
    if (document.querySelector('select[name="role"]').value === 'manager') {
        document.getElementById('branch-select').style.display = 'block';
    }
</script>

@endsection
