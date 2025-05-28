@extends('Manager.layouts.app')
@section('title', 'Quản Lý Tồn Kho')
@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách tồn kho</h2>
        @if(auth()->user()->role != 'admin')
        <div>
            <a href="{{ route('manager.inventories.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Tạo mới
            </a>
        </div>
        @endif
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.inventories.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm theo tên sản phẩm..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Thương hiệu</th>
                            <th>Số lượng nhập</th>
                            <th>Ngày tạo</th>
                            @if(auth()->user()->role != 'admin')
                                <th class="text-end">Hành động</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->product->name ?? '[Sản phẩm bị xóa]' }}</td>
                                <td>{{ $inventory->brand->name ?? 'Không có' }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>{{ $inventory->created_at->format('d/m/Y H:i') }}</td>
                                @if(auth()->user()->role != 'admin')
                                <td class="text-end">
                                    <a href="{{ route('manager.inventories.edit', $inventory->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="icon material-icons md-edit"></i>
                                    </a>
                                    <form action="{{ route('manager.inventories.destroy', $inventory->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa bản ghi tồn kho này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded font-sm" title="Xóa">
                                            <i class="icon material-icons md-delete"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation">
            {{ $inventories->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
