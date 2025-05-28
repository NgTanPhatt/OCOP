@extends('manager.layouts.app')
@section('title', 'Quản Lý Tin Tức')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách tin tức</h2>
        <div>
            <a href="{{ route('manager.news.create') }}" class="btn btn-primary">
                <i class="material-icons md-plus"></i> Tạo mới
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3">
                <form action="{{ route('manager.news.index') }}" method="GET" class="col-lg-4 col-md-6 me-auto">
                    <input type="text" name="search" placeholder="Tìm kiếm theo tiêu đề..." class="form-control" value="{{ request('search') }}" />
                </form>
            </div>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Hình Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Cửa hàng</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsList as $news)
                            <tr>
                                <td>
                                    @if ($news->avatar)
                                        <img src="{{ asset('storage/' . $news->avatar) }}" alt="Avatar" width="100" height="100" style="object-fit: cover;">
                                    @endif
                                </td>
                                <td>{{ $news->name }}</td>
                                <td>{{ Str::limit(strip_tags($news->content), 50) }}</td>
                                <td>{{ $news->branch->name ?? 'Không có' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('manager.news.edit', $news->id) }}" class="btn btn-sm btn-light rounded font-sm" title="Sửa">
                                        <i class="icon material-icons md-edit"></i>
                                    </a>
                                    <form action="{{ route('manager.news.destroy', $news->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin tức này?')">
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
            {{ $newsList->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
