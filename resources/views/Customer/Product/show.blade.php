@extends('customer.layouts.app')
@section('title', $product->name)
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> <a href="{{ route('customer.products.index') }}">Sản Phẩm</a> <span></span> {{ $product->name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50 mt-30">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        @php
                                            $images = explode('#', $product->images);
                                        @endphp
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @foreach($images as $image)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="product image" style="width: 100%; height: 500px;" />
                                                </figure>
                                            @endforeach
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails">
                                            @foreach($images as $image)
                                                <div><img src="{{ asset('storage/' . $image) }}" alt="product image" style="width: 100%; height: 114px;" /></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info pr-30 pl-30">
                                        <h4 class="title-detail">{{ $product->name }}</h4>
                                        <div class="product-detail-rating">
                                            <div class="product-rate-cover text-end">
                                                @php
                                                    $star = $product->star ?? 0;
                                                    $starPercentProduct = ($star / 5) * 100;
                                                    $reviewCount = $product->reviews->count();
                                                @endphp
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: {{ $starPercentProduct }}%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{ $reviewCount }})</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <span class="current-price text-brand" style="font-size: 29px;">{{ number_format($product->price) }}đ</span>
                                            </div>
                                        </div>
                                        <div class="shipping-info mb-30">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p>Gửi từ</p>
                                                    <p>Nhận hàng</p>
                                                    <p>Vận chuyển</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <p style="cursor: pointer;" class="product-name" title="{{ $product->branch->address }}"><strong>{{ $product->branch->address }}</strong></p>
                                                    <p id="user-location" class="product-name" style="cursor: pointer;" title=""><strong id="location-text">Đang lấy vị trí...</strong></p>
                                                    <div id="location-modal" style="display: none; position: absolute; z-index: 1000; background: white; border: 1px solid #ccc; padding: 15px; border-radius: 10px;">
                                                        <div style="display: flex; gap: 10px;">
                                                            <div>
                                                                <strong>Tỉnh/Thành</strong>
                                                                <ul id="province-list"></ul>
                                                            </div>
                                                            <div>
                                                                <strong>Quận/Huyện</strong>
                                                                <ul id="district-list"></ul>
                                                            </div>
                                                            <div>
                                                                <strong>Phường/Xã</strong>
                                                                <ul id="ward-list"></ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p><strong>30.000đ</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('customer.carts.store') }}" method="POST" class="detail-extralink mb-50">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" class="qty-val" value="1" min="1" required>
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Thêm Giỏ Hàng</button>
                                                <button type="submit" name="buy_now" class="button button-add-to-cart"><i class="fi-rs-shopping-bag"></i>Mua Ngay</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Mô Tả</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Đánh Giá ({{ $product->reviews->count() }})</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Reviews">
                                            <!--Comments-->
                                            <div class="comments-area">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-30">Nội Dung</h4>
                                                        <div class="comment-list">
                                                            @foreach($reviews as $review)
                                                                <div class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-block">
                                                                        <div class="thumb text-center mb-10">
                                                                            <a href="#" class="font-heading text-brand">
                                                                                {{ $review->user->fullname ?? 'Ẩn danh' }}
                                                                            </a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">{{ $review->created_at->format('d/m/Y \l\ú\c H:i') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">
                                                                                {{ $review->content }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating" style="width: {{ $review->star * 20 }}%"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <h4 class="mb-30">Số Sao</h4>
                                                        <div class="d-flex mb-30">
                                                            <div class="product-rate d-inline-block mr-15">
                                                                <div class="product-rating" style="width: {{ $averageStar * 20 }}%"></div>
                                                            </div>
                                                            <h6>{{ $averageStar }} / 5</h6>
                                                        </div>

                                                        @for ($i = 5; $i >= 1; $i--)
                                                            <div class="progress mb-2">
                                                                <span>{{ $i }} sao</span>
                                                                <div class="progress-bar" role="progressbar" style="width: {{ $starPercentages[$i] }}%" aria-valuenow="{{ $starPercentages[$i] }}" aria-valuemin="0" aria-valuemax="100">
                                                                    {{ $starPercentages[$i] }}%
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <!--comment form-->
                                            <div class="comment-form">
                                                <h4 class="mb-15">Đánh Giá</h4>

                                                <!-- ⭐ Rating stars -->
                                                <div class="d-inline-block mb-30">
                                                    <div class="rating-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="star-icon fi-rs-star" data-value="{{ $i }}"></i>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="star" id="star-rating" value="5">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <form class="form-contact comment_form" action="{{ route('customer.reviews.store') }}" method="POST" id="commentForm">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="4" placeholder="Nội dung"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <input type="hidden" name="star" id="star-rating-submit" value="0">
                                                            <div class="form-group">
                                                                <button type="submit" class="button button-contactForm">Đánh Giá</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h2 class="section-title style-1 mb-30">Sản Phẩm Liên Quan</h2>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach ($relatedProducts as $item)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6 mt-10">
                                                <div class="product-cart-wrap hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{ route('customer.products.show', $item->id) }}">
                                                                <img style="width: 100%; height: 251px;" class="default-img" src="{{ asset('storage/' . $item->avatar) }}" alt="" />
                                                                <img style="width: 100%; height: 251px;" class="hover-img" src="{{ asset('storage/' . $item->avatar) }}" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <h2><a class="product-name" href="{{ route('customer.products.show', $item->id) }}">{{ $item->name }}</a></h2>
                                                        <div class="rating-result" title="90%">
                                                            <span> </span>
                                                        </div>
                                                        <div class="product-price">
                                                            <span>{{ number_format($item->price, 0, ',', '.') }}₫</span>
                                                            @if ($item->original_price && $item->original_price > $item->price)
                                                                <span class="old-price">{{ number_format($item->original_price, 0, ',', '.') }}₫</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30">
                        <div class="sidebar-widget widget-vendor mb-30 bg-grey-9 box-shadow-none">
                            <h5 class="section-title style-3 mb-20">Thông Tin Cửa Hàng</h5>
                            <div class="vendor-logo d-flex mb-30">
                                <img style="width: 64px; height: 43px;" src="{{ asset('storage/' . $product->branch->avatar) }}" alt="" />
                                <div class="vendor-name ml-15">
                                    <h6>
                                        <a href="{{ route('customer.branches.show', $product->branch->id) }}">{{ $product->branch->name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: {{ round($countStar / 5 * 100) }}%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{ $reviewCountBranch }})</span>
                                    </div>
                                </div>
                            </div>
                            <ul class="contact-infor">
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>{{ $product->branch->address }}</strong> <span></span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" />
                                    @php
                                        $phone = preg_replace('/[^0-9]/', '', $product->branch->phone); // loại bỏ ký tự không phải số
                                        $formattedPhone = preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1.$2.$3', $phone);
                                    @endphp
                                    <strong>{{ $formattedPhone }}</strong><span></span>
                                </li>
                                <li class="hr"><span></span></li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="text-brand font-xs">Đánh Giá</p>
                                    <h4 class="mb-0 text-center">{{ number_format(round($countStar * 2) / 2, 1) }}</h4>
                                </div>
                                <div>
                                    <p class="text-brand font-xs">Sản Phẩm</p>
                                    <h4 class="mb-0 text-center">{{ $countProduct }}</h4>
                                </div>
                                <div>
                                    <p class="text-brand font-xs">Đã Bán</p>
                                    <h4 class="mb-0 text-center">{{ $countNumberOfPurchases }}</h4>
                                </div>
                            </div>
                            <ul>
                                <li class="hr"><span></span></li>
                            </ul>
                            <p><a href="{{ route('customer.branches.show', $product->branch->id) }}">Xem Cửa Hàng</a></p>
                        </div>
                        <!-- Product sidebar Widget -->
                        @if(count($recommendations) > 0)
                        <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                            <h5 class="section-title style-1 mb-30">Sản Phẩm Đề Xuất</h5>
                            @foreach ($recommendations as $recommendation)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img style="width: 100%; height: 80px;" src="{{ asset('storage/' . $recommendation['avatar']) }}" alt="{{ $recommendation['name'] }}" />
                                    </div>
                                    <div class="content pt-10">
                                        <h5 style="font-size: medium;" title="{{ $recommendation['name'] }}">
                                            <a href="{{ route('customer.products.show', $recommendation['product_id']) }}">
                                                {{ $recommendation['name'] }}
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    .shipping-info p {
        margin-bottom: 20px;
        font-size: 18px;
    }
    .rating-stars {
        cursor: pointer;
    }
    .star-icon {
        font-size: 24px;
        color: #ccc;
    }
    .star-icon.active {
        color: #f6b500;
    }
    #location-modal ul {
        list-style: none;
        padding: 0;
        max-height: 200px;
        overflow-y: auto;
    }

    #location-modal ul li:hover {
        background-color: #f0f0f0;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            text: "{{ session('success') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            text: "{{ session('error') }}",
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
<script>
    const stars = document.querySelectorAll('.star-icon');
    const ratingInput = document.getElementById('star-rating-submit');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;

            stars.forEach(s => {
                if (s.getAttribute('data-value') <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });
    });
</script>
<script>
    let provincesData = [];

    document.addEventListener("DOMContentLoaded", () => {
        const locationText = document.getElementById("location-text");
        const locationModal = document.getElementById("location-modal");
        const provinceList = document.getElementById("province-list");
        const districtList = document.getElementById("district-list");
        const wardList = document.getElementById("ward-list");

        // Lấy dữ liệu địa lý
        fetch("https://provinces.open-api.vn/api/?depth=3")
            .then(res => res.json())
            .then(data => {
                provincesData = data;
                data.forEach(province => {
                    const li = document.createElement("li");
                    li.textContent = province.name;
                    li.style.cursor = "pointer";
                    li.onclick = () => loadDistricts(province);
                    provinceList.appendChild(li);
                });
            });

        // Hiển thị popup chọn
        document.getElementById("user-location").addEventListener("click", () => {
            locationModal.style.display = "block";
        });

        function closeLocationModal() {
            locationModal.style.display = "none";
        }

        window.closeLocationModal = closeLocationModal;

        function loadDistricts(province) {
            districtList.innerHTML = '';
            wardList.innerHTML = '';
            province.districts.forEach(district => {
                const li = document.createElement("li");
                li.textContent = district.name;
                li.style.cursor = "pointer";
                li.onclick = () => loadWards(province, district);
                districtList.appendChild(li);
            });
        }

        function loadWards(province, district) {
            wardList.innerHTML = '';
            district.wards.forEach(ward => {
                const li = document.createElement("li");
                li.textContent = ward.name;
                li.style.cursor = "pointer";
                li.onclick = () => {
                    const fullAddress = `${ward.name}, ${district.name}, ${province.name}`;
                    document.getElementById("location-text").textContent = fullAddress;
                    document.getElementById("user-location").title = fullAddress;
                    closeLocationModal();
                };
                wardList.appendChild(li);
            });
        }

        // Tự động định vị ban đầu (có thể giữ lại nếu muốn)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
                    .then(res => res.json())
                    .then(data => {
                        const addr = data.address || {};
                        const ward = addr.suburb || addr.village || addr.hamlet || addr.neighbourhood || '';
                        const district = addr.county || addr.district || '';
                        const province = addr.state || addr.city || addr.town || '';
                        const result = [ward, district, province].filter(Boolean).join(', ');
                        locationText.textContent = result || 'Không xác định được vị trí';
                        document.getElementById("user-location").title = result;
                    });
            });
        }
    });
</script>
<script>
    document.addEventListener("click", function (event) {
        const modal = document.getElementById("location-modal");
        const trigger = document.getElementById("user-location");

        if (!modal.contains(event.target) && !trigger.contains(event.target)) {
            modal.style.display = "none";
        }
    });
</script>
@endsection