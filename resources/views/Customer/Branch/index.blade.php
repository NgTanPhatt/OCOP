@extends('customer.layouts.app')
@section('title', 'Gian Hàng')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Gian Hàng
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Gian Hàng</h1>
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form method="GET" action="{{ route('customer.branches.index') }}">
                                    <input type="text" name="search" placeholder="Tên, số điện thoại, địa chỉ..." value="{{ request('search') }}" required>
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row vendor-grid">
                @foreach ($branches as $branch)
                    @php
                        $branchId = $branch->id;
                        $reviewCount = App\Models\Review::whereHas('product', function ($query) use ($branchId) {
                            $query->where('branch_id', $branchId);
                        })->count();

                        $countStar = App\Models\Product::where('branch_id', $branchId)->where('star', '!=', 0)->avg('star');
                    @endphp
                    <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">{{ $branch->products->count() }} sản phẩm</span>
                                </div>
                                <div class="vendor-img">
                                    <a href="{{ route('customer.branches.show', $branch->id) }}">
                                        <img class="default-img" style="width: 100%; height: 144px; object-fit: cover;" 
                                            src="{{ $branch->avatar ? asset('storage/' . $branch->avatar) : asset('frontend/assets/imgs/vendor/default.png') }}" 
                                            alt="{{ $branch->name }}">
                                    </a>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                        <div class="product-category">
                                            <span class="text-muted">Đăng ký: {{ $branch->created_at->format('Y') }}</span>
                                        </div>
                                        <h4 class="mb-5">
                                            <a href="{{ route('customer.branches.show', $branch->id) }}">{{ $branch->name }}</a>
                                        </h4>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: {{ round($countStar / 5 * 100) }}%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted">({{ $reviewCount }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li>
                                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="">
                                            <strong>Địa chỉ:</strong>
                                            <span>{{ $branch->address }}</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="">
                                            <strong>Liên hệ:</strong>
                                            <span>{{ $branch->phone }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('customer.branches.show', $branch->id) }}" class="btn btn-xs">
                                    Xem gian hàng <i class="fi-rs-arrow-small-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-area mt-20 mb-20">
                {{ $branches->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection