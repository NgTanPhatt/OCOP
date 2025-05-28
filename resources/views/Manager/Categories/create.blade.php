@extends('manager.layouts.app')
@section('title', 'Tạo Danh Mục')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Tạo Danh Mục</h2>
            <div>
                <a href="{{ route('manager.categories.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="create-form" type="submit" class="btn btn-primary rounded font-sm">Tạo Mới</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Danh Mục</h4>
            </div>
            <div class="card-body">
                <form id="create-form" method="POST" action="{{ route('manager.categories.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="name" value="{{ old('name') }}"
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
