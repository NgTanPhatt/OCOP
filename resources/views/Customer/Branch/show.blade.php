@extends('customer.layouts.app')
@section('title', $branch->name)
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> <a href="{{ route('customer.branches.index') }}">Gian Hàng</a> <span></span> {{ $branch->name }}
            </div>
        </div>
    </div>
    <div class="container mb-30" style="transform: none;">
        <div class="archive-header-3 mt-30 mb-80" style="background-image: url({{ asset('frontend/assets/imgs/vendor/vendor-header-bg.png') }})">
            <div class="archive-header-3-inner">
                <div class="vendor-logo mr-50">
                    <img style="width: 136px; height: 150px;" src="{{ asset('storage/' . $branch->avatar) }}" alt="">
                </div>
                <div class="vendor-content">
                    <div class="product-category">
                        <span class="text-muted">Since {{ $branch->created_at->format('Y') }}</span>
                    </div>
                    <h3 class="mb-5 text-white"><a href="#" class="text-white">{{ $branch->name }}</a></h3>
                    <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: {{ round($countStar / 5 * 100) }}%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{ $reviewCount }})</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="vendor-info text-white mb-15">
                                <ul class="font-sm" style="line-height: 30px;">
                                    <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt=""><strong>Địa chỉ: </strong> <span>{{ $branch->address }}</span></li>
                                    <li></li>
                                    <li><img class="mr-5" src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt=""><strong>Liên hệ:</strong><span> {{ $branch->phone }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-row-reverse" style="transform: none;">
            <div class="col-lg-4-5">
                <div class="row product-grid">

                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('customer.products.show', $product->id) }}">
                                            <img style="width: 100%; height: 182px;" class="default-img"
                                                src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}" />
                                            <img style="width: 100%; height: 182px;" class="hover-img"
                                                src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}" />
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category mt-2">
                                        <a
                                            href="{{ route('customer.categories.index', $product->category->id) }}">{{ $product->category->name }}</a>
                                    </div>
                                    <h2 class="product-name"><a title="{{ $product->name }}"
                                            href="{{ route('customer.products.show', $product->id) }}">{{ $product->name }}</a>
                                    </h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            @php
                                                $star = $product->star ?? 0;
                                                $starPercent = ($star / 5) * 100;
                                                $reviewCount = $product->reviews->count();
                                            @endphp
                                            <div class="product-rating" style="width: {{ $starPercent }}%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">({{ $reviewCount ?: '0' }})</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted"><a
                                                href="{{ route('customer.branches.show', $product->branch->id) }}">{{ $product->branch->name ?? 'Không rõ' }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>{{ number_format($product->price) }}₫</span>
                                            @if($product->original_price && $product->original_price > $product->price)
                                                <span class="old-price">{{ number_format($product->original_price) }}₫</span>
                                            @endif
                                        </div>
                                        <div class="add-cart">
                                            <a class="add" href="{{ route('customer.products.show', $product->id) }}"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Mua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
            
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 159.5px;">
                    <div class="sidebar-widget price_range range mb-30">
                        <h5 class="section-title style-1 mb-30">Tìm Sản Phẩm</h5>
                        <form method="GET">
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div class="d-flex justify-content-between mb-15">
                                        <div class="w-100">
                                            <label class="form-label fw-bold">Tên sản phẩm</label>
                                            <input type="text" class="form-control w-100" name="name" value="{{ request('name') }}" placeholder="Tên sản phẩm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div class="d-flex justify-content-between mb-15">
                                        <div class="w-50 pe-2">
                                            <label class="form-label fw-bold">Từ giá</label>
                                            <input type="number" class="form-control" name="price_from" value="{{ request('price_from') }}" placeholder="VND" min="0">
                                        </div>
                                        <div class="w-50 ps-2">
                                            <label class="form-label fw-bold">Đến giá</label>
                                            <input type="number" class="form-control" name="price_to" value="{{ request('price_to') }}" placeholder="VND" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900">Danh mục</label>
                                    <div class="custome-checkbox" style="max-height: 250px; overflow-y: auto;">
                                        @foreach ($categories as $index => $category)
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="category[]"
                                                    id="category-{{ $index }}" value="{{ $category->id }}"
                                                    {{ in_array($category->id, (array) request('category')) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="category-{{ $index }}">
                                                    <span>{{ $category->name }}</span>
                                                </label>
                                                <br />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Lọc</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection