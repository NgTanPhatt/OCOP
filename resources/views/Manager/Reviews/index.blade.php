@extends('Manager.layouts.app')
@section('title', 'Quản Lý Đánh Giá')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách đánh giá</h2>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.reviews.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm tên sản phẩm..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Người đánh giá</th>
                            <th>Đánh giá</th>
                            <th>Thời gian</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->product->name ?? 'N/A' }}</td>
                                <td>{{ $review->user->username ?? 'N/A' }}</td>
                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->star)
                                            <i class="icon material-icons md-star text-warning"></i>
                                        @else
                                            <i class="icon material-icons md-star_border text-muted"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <form action="{{ route('manager.reviews.destroy', $review->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">
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
        <nav>
            {{ $reviews->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
