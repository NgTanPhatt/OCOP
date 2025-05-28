@extends('manager.layouts.app')
@section('title', 'Tạo Thương Hiệu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Tạo Thương Hiệu</h2>
            <div>
                <a href="{{ route('manager.brands.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="create-form" type="submit" class="btn btn-primary rounded font-sm">Tạo Mới</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Thương Hiệu</h4>
            </div>
            <div class="card-body">
                <form id="create-form" method="POST" action="{{ route('manager.brands.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Tên Thương Hiệu</label>
                        <input type="text" name="name" value="{{ old('name') }}"
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
