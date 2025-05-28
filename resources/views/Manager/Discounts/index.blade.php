@extends('manager.layouts.app')
@section('title', 'Quản Lý Mã Giảm Giá')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách mã giảm giá</h2>
        <div>
            <a href="{{ route('manager.discounts.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Tạo mới
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.discounts.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm theo mã giảm giá..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã Giảm Giá</th>
                            <th>Phần Trăm Giảm</th>
                            <th>Ngày Hết Hạn</th>
                            <th>Cửa Hàng</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $discount->code }}</td>
                                <td>{{ $discount->percent }}%</td>
                                <td>{{ \Carbon\Carbon::parse($discount->expiration_date)->format('d/m/Y') }}</td>
                                <td>{{ $discount->branch->name ?? 'Không xác định' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('manager.discounts.edit', $discount->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="icon material-icons md-edit"></i>
                                    </a>
                                    <form action="{{ route('manager.discounts.destroy', $discount->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')">
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
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation">
            {{ $discounts->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
