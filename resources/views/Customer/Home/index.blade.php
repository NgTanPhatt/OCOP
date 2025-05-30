@extends('customer.layouts.app')
@section('title', 'Trang Chủ')
@section('content')
    <section class="home-slider style-2 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-12">
                    <div class="home-slide-cover">
                        <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                            <div class="single-hero-slider single-animation-wrap" style="background-image: url(https://dyh48pub5c8mm.cloudfront.net/home/adv/s3_2025012213591594491.png)">
                            </div>
                            <div class="single-hero-slider single-animation-wrap" style="background-image: url(https://dyh48pub5c8mm.cloudfront.net/home/adv/s3_2024050210030327690.png)">
                            </div>
                        </div>
                        <div class="slider-arrow hero-slider-1-arrow"></div>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-xl-block">
                    <div class="banner-img style-3 animated animated" style="background-image: url(https://dyh48pub5c8mm.cloudfront.net/home/adv/s3_2024050210032124577.png">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End hero slider-->
    <section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
                    <h3>Danh Mục</h3>
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                    id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach ($categories as $category)
                    <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s" >
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="{{ route('customer.categories.index', $category->id) }}">
                                <img src="{{ asset('storage/' . $category->avatar) }}" alt="{{ $category->name }}" style="width: 80px; height: 80px;" />
                            </a>
                        </figure>
                        <h6 class="product-name">
                            <a href="{{ route('customer.categories.index', $category->id) }}">{{ $category->name }}</a>
                        </h6>
                        <span>{{ $category->products_count }} sản phẩm</span>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>

    <!--End banners-->
    @foreach ($categories as $category)
        @php
            $products = \App\Models\Product::where('category_id', $category->id)->take(10)->get();
        @endphp
        <section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3>{{ $category->name }}</h3>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-{{ $category->id }}" role="tabpanel">
                        <div class="row product-grid-4">
                            @foreach ($products as $product)
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('customer.products.show', $product->id) }}">
                                                    <img style="width: 100%; height: 246px;" class="default-img" src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}" />
                                                    <img style="width: 100%; height: 246px;" class="hover-img" src="{{ asset('storage/' . $product->avatar) }}" alt="{{ $product->name }}" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category mt-2">
                                                <a href="{{ route('customer.categories.index', $category->id) }}">{{ $category->name }}</a>
                                            </div>
                                            <h2 class="product-name"><a title="{{ $product->name }}" href="{{ route('customer.products.show', $product->id) }}">{{ $product->name }}</a></h2>
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
                                                <span class="font-small text-muted"><a href="{{ route('customer.branches.show', $product->branch->id) }}">{{ $product->branch->name ?? 'Không rõ' }}</a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <span>{{ number_format($product->price) }}₫</span>
                                                    @if($product->original_price && $product->original_price > $product->price)
                                                        <span class="old-price">{{ number_format($product->original_price) }}₫</span>
                                                    @endif
                                                </div>
                                                <div class="add-cart">
                                                    <a class="add" href="{{ route('customer.products.show', $product->id) }}"><i class="fi-rs-shopping-cart mr-5"></i>Mua</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- end foreach product -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('customer.categories.index', $category->id) }}" class="btn btn-primary">
                    Xem thêm sản phẩm
                </a>
            </div>
        </section>
    @endforeach


@endsection