@extends('Manager.layouts.app')
@section('title', 'Quản Lý Cửa Hàng')
@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách cửa hàng</h2>
        <div>
            <a href="{{ route('manager.branches.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Tạo mới</a>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <!-- Form tìm kiếm -->
                <form action="{{ route('manager.branches.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên cửa hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Chủ Cửa Hàng</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>{{ $branch->email }}</td>
                                <td>{{ $branch->user->fullname }}</td>
                                <td class="text-end">
                                    <!-- Xem chi tiết -->
                                    <a href="{{ route('manager.branches.edit', $branch->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="icon material-icons md-edit"></i> <!-- Icon sửa -->
                                    </a>

                                    <!-- Xóa -->
                                    <form action="{{ route('manager.branches.destroy', $branch->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa chi nhánh này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded font-sm" title="Xóa">
                                            <i class="icon material-icons md-delete"></i> <!-- Icon xóa -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- table-responsive.// -->
            </div>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation example">
            {{ $branches->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
