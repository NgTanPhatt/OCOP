@extends('Manager.layouts.app')
@section('title', 'Quản Lý Danh Mục')
@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách danh mục</h2>
        @if(auth()->user()->role == 'admin')
        <div>
            <a href="{{ route('manager.categories.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Tạo mới
            </a>
        </div>
        @endif
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.categories.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên danh mục</th>
                            <th>Số sản phẩm</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="text-end">Hành động</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    @if ($category->avatar)
                                        <img src="{{ asset('storage/' . $category->avatar) }}" alt="Avatar" style="width: 100px; height: 100px;">
                                    @else
                                        <span class="text-muted">Không có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }} sản phẩm</td>
                                @if(auth()->user()->role == 'admin')
                                <td class="text-end">
                                    <a href="{{ route('manager.categories.edit', $category->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="icon material-icons md-edit"></i>
                                    </a>
                                    <form action="{{ route('manager.categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa chuyên mục này?')">
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
        <nav aria-label="Page navigation example">
            {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
