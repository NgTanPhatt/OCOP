@extends('Manager.layouts.app')
@section('title', 'Quản Lý Sản Phẩm')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách sản phẩm</h2>
        <div>
            <a href="{{ route('manager.products.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Thêm mới
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <form action="{{ route('manager.products.index') }}" method="GET">
                <div class="row gx-2 gy-2 align-items-center">
                    <div class="col-lg-3">
                        <input type="text" name="name" class="form-control" placeholder="Tên sản phẩm" value="{{ request('name') }}">
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="category_id">
                            <option value="">-- Danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(auth()->user()->role == 'admin')
                    <div class="col-lg-3">
                        <select class="form-control" name="branch_id">
                            <option value="">-- Chi nhánh --</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="col-lg-3">
                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Lượt mua</th>
                            <th>Danh mục</th>
                            <th>Chi nhánh</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $product->avatar) }}" alt="Ảnh" style="width: 80px; height: 80px;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }} đ</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->number_of_purchases }}</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td>{{ $product->branch->name ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('manager.products.edit', $product->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="material-icons md-edit"></i>
                                    </a>
                                    <form action="{{ route('manager.products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded font-sm" title="Xoá">
                                            <i class="material-icons md-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted">Không có sản phẩm nào phù hợp.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
