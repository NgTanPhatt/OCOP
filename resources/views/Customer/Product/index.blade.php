@extends('Customer.layouts.app')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Sản Phẩm
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>Hiện có <strong class="text-brand">{{ $products->count() }}</strong> sản phẩm!</p>
                    </div>
                    <form method="GET" action="{{ route('customer.products.index') }}">
                        {{-- Giữ lại các bộ lọc nếu có --}}
                        <input type="hidden" name="name" value="{{ request('name') }}">
                        <input type="hidden" name="price_from" value="{{ request('price_from') }}">
                        <input type="hidden" name="price_to" value="{{ request('price_to') }}">
                        @if(request()->has('province'))
                            @foreach((array) request('province') as $province)
                                <input type="hidden" name="province[]" value="{{ $province }}">
                            @endforeach
                        @endif

                        <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
                            <span class="fw-bold me-2">Sắp xếp:</span>

                            <button type="submit" name="sort" value="new" class="btn btn-sm bg-white text-dark filter_order">
                                Hàng mới
                            </button>

                            <button type="submit" name="sort" value="price_asc" class="btn btn-sm bg-white text-dark filter_order">
                                Giá thấp đến cao
                            </button>

                            <button type="submit" name="sort" value="price_desc" class="btn btn-sm bg-white text-dark filter_order">
                                Giá cao đến thấp
                            </button>
                        </div>
                    </form>
                </div>
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
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Danh Mục</h5>
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('customer.categories.index', $category->id) }}">
                                    <img src="{{ asset('storage/' . $category->avatar) }}" alt="{{ $category->name }}"
                                        style="width: 30px; height: 30px;" />
                                    {{ $category->name }}
                                </a>
                                <span class="count">{{ $category->products_count }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <!-- Fillter By Price -->
                @php
                    $provinces = [
                        'An Giang',
                        'Bà Rịa - Vũng Tàu',
                        'Bắc Giang',
                        'Bắc Kạn',
                        'Bạc Liêu',
                        'Bắc Ninh',
                        'Bến Tre',
                        'Bình Định',
                        'Bình Dương',
                        'Bình Phước',
                        'Bình Thuận',
                        'Cà Mau',
                        'Cần Thơ',
                        'Cao Bằng',
                        'Đà Nẵng',
                        'Đắk Lắk',
                        'Đắk Nông',
                        'Điện Biên',
                        'Đồng Nai',
                        'Đồng Tháp',
                        'Gia Lai',
                        'Hà Giang',
                        'Hà Nam',
                        'Hà Nội',
                        'Hà Tĩnh',
                        'Hải Dương',
                        'Hải Phòng',
                        'Hậu Giang',
                        'Hòa Bình',
                        'Hưng Yên',
                        'Khánh Hòa',
                        'Kiên Giang',
                        'Kon Tum',
                        'Lai Châu',
                        'Lâm Đồng',
                        'Lạng Sơn',
                        'Lào Cai',
                        'Long An',
                        'Nam Định',
                        'Nghệ An',
                        'Ninh Bình',
                        'Ninh Thuận',
                        'Phú Thọ',
                        'Phú Yên',
                        'Quảng Bình',
                        'Quảng Nam',
                        'Quảng Ngãi',
                        'Quảng Ninh',
                        'Quảng Trị',
                        'Sóc Trăng',
                        'Sơn La',
                        'Tây Ninh',
                        'Thái Bình',
                        'Thái Nguyên',
                        'Thanh Hóa',
                        'Thừa Thiên Huế',
                        'Tiền Giang',
                        'TP Hồ Chí Minh',
                        'Trà Vinh',
                        'Tuyên Quang',
                        'Vĩnh Long',
                        'Vĩnh Phúc',
                        'Yên Bái'
                    ];
                @endphp
                <form method="GET" action="{{ route('customer.products.index') }}">
                    {{-- Giữ lại sắp xếp nếu có --}}
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="hidden" name="name" value="{{ request('name') }}">
                    <div class="sidebar-widget price_range range mb-30">
                        <h5 class="section-title style-1 mb-30">Lọc Theo Giá</h5>
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
                                <label class="fw-900">Khu vực</label>
                                <div class="custome-checkbox" style="max-height: 250px; overflow-y: auto;">
                                    @foreach ($provinces as $index => $province)
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="province[]"
                                                id="province-{{ $index }}" value="{{ $province }}"
                                                {{ in_array($province, (array) request('province')) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="province-{{ $index }}">
                                                <span>{{ $province }}</span>
                                            </label>
                                            <br />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>Lọc</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<style>
    button.submit:hover, button[type=submit]:hover {
        background-color: white !important;
        border-color: #3BB77E;
    }
</style>
@endsection