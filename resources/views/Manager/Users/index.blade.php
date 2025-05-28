@extends('manager.layouts.app')
@section('title', 'Quản Lý Người Dùng')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách người dùng</h2>
        @if(auth()->user()->role == 'admin')
        <div>
            <a href="{{ route('manager.users.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Tạo mới
            </a>
        </div>
        @endif
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.users.index') }}" method="GET" class="row gx-3 col-lg-10">
                    <div class="col-lg-3 col-md-3">
                        <input type="text" name="search" placeholder="Tìm kiếm theo tên, tài khoản, số điện thoại" class="form-control" value="{{ request('search') }}" />
                    </div>
                    @if(auth()->user()->role == 'admin')
                    <div class="col-lg-3 col-md-3">
                        <select class="form-select" name="role" onchange="this.form.submit()">
                            <option value="">Tất cả vai trò</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>
                    @endif
                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-primary w-100 justify-content-center">Lọc</button>
                    </div>
                </form>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    @if(auth()->user()->role == 'admin')
                        <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Vai Trò</th>
                                <th>Cửa Hàng</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->branch->name ?? 'Không có' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('manager.users.edit', $user->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                            <i class="icon material-icons md-edit"></i>
                                        </a>
                                        <form action="{{ route('manager.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded font-sm" title="Xóa">
                                                <i class="icon material-icons md-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Số Hóa Đơn</th>
                                <th>Tham Gia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->orders->count() }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
