@extends('manager.layouts.app')
@section('title', 'Sửa Danh Mục')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Sửa Danh Mục</h2>
            <div>
                <a href="{{ route('manager.categories.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="edit-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Danh Mục</h4>
            </div>
            <div class="card-body">
                <form id="edit-form" method="POST" action="{{ route('manager.categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên danh mục">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($category->avatar)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $category->avatar) }}" alt="Avatar" class="img-thumbnail" style="width: 100px; height: 100px;">
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
