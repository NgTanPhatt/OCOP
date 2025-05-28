@extends('manager.layouts.app')
@section('title', 'Sửa Tin Tức')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Sửa Tin Tức</h2>
            <div>
                <a href="{{ route('manager.news.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="edit-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Tin Tức</h4>
            </div>
            <div class="card-body">
                <form id="edit-form" method="POST" action="{{ route('manager.news.update', $news->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (Auth::user()->role === 'admin')
                        <div class="mb-4">
                            <label class="form-label">Chọn Cửa Hàng</label>
                            <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror">
                                <option value="">-- Chọn cửa hàng --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id', $news->branch_id) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="name" value="{{ old('name', $news->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tiêu đề tin tức">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ảnh đại diện</label>
                        @if ($news->avatar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $news->avatar) }}" alt="Ảnh hiện tại" width="120" height="100">
                            </div>
                        @endif
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content', $news->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('textarea[name="content"]'))
        .then(editor => {
            editor.ui.view.editable.element.style.minHeight = '400px';
        })
        .catch(error => {
            console.error(error);
        });
</script>
<style>
    .ck-editor__editable_inline {
        min-height: 400px !important;
    }
</style>
@endsection
