@extends('manager.layouts.app')
@section('title', 'Sửa Thương Hiệu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Sửa Thương Hiệu</h2>
            <div>
                <a href="{{ route('manager.brands.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="edit-form" type="submit" class="btn btn-primary rounded font-sm">Cập Nhật</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Thương Hiệu</h4>
            </div>
            <div class="card-body">
                <form id="edit-form" method="POST" action="{{ route('manager.brands.update', $brand->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Phương thức PUT để cập nhật -->

                    <div class="mb-4">
                        <label class="form-label">Tên Thương Hiệu</label>
                        <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên thương hiệu">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
