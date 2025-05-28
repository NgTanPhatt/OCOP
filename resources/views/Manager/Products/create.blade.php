@extends('manager.layouts.app')
@section('title', 'Tạo Sản Phẩm')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Tạo Sản Phẩm</h2>
            <div>
                <a href="{{ route('manager.products.index') }}" class="btn btn-light rounded font-sm">Quay Lại</a>
                <button form="create-form" type="submit" class="btn btn-primary rounded font-sm">Tạo Mới</button>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thông Tin Sản Phẩm</h4>
            </div>
            <div class="card-body">
                <form id="create-form" method="POST" action="{{ route('manager.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sản phẩm">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror" placeholder="Nhập giá">
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tồn kho</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}"
                               class="form-control @error('stock') is-invalid @enderror" placeholder="Nhập số lượng tồn kho">
                        @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    @if (auth()->user()->role == 'admin')
                        <div class="mb-4">
                            <label class="form-label">Chi nhánh</label>
                            <select name="branch_id" class="form-control @error('branch_id') is-invalid @enderror">
                                <option value="">-- Chọn chi nhánh --</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
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
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ảnh chi tiết (nhiều ảnh, nếu có)</label>
                        <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror">
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mô tả</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="6" placeholder="Nhập mô tả"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
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

