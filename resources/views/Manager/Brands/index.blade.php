@extends('manager.layouts.app')

@section('title', 'Quản Lý Thương Hiệu')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách thương hiệu</h2>
        <div>
            <a href="{{ route('manager.brands.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Tạo Mới</a>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <!-- Form tìm kiếm -->
                <form action="{{ route('manager.brands.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên Thương Hiệu</th>
                        <th>Số Lượng Nhập</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->inventories_sum_quantity }} sản phẩm</td>
                            <td class="text-end">
                                <!-- Xem chi tiết -->
                                <a href="{{ route('manager.brands.edit', $brand->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                    <i class="icon material-icons md-edit"></i> <!-- Icon sửa -->
                                </a>

                                <!-- Xóa -->
                                <form action="{{ route('manager.brands.destroy', $brand->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?')">
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

            <div class="pagination-area mt-15 mb-50">
                {{ $brands->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
