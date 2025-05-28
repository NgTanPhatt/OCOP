@extends('Customer.layouts.app')
@section('title', $news->name)
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> <a href="{{ route('customer.news.index') }}">Tin Tức</a> <span></span> {{ $news->name }}
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <div class="single-page pt-20 pr-30">
                        <div class="single-header style-2">
                            <div class="row">
                                <div class="col-xl-10 col-lg-12 m-auto">
                                    <h6 class="mb-10"><a href="#">Tin Tức</a></h6>
                                    <h2 class="mb-10">{{ $news->name }}</h2>
                                    <div class="single-header-meta">
                                        <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                            <a class="author-avatar" href="#">
                                                <img style="width: 30px; height: 30px; border-radius: 50%;" class="img-circle" src="{{ asset('storage/' . $news->branch->avatar) }}" alt="">
                                            </a>
                                            <span class="post-by"><a href="{{ route('customer.branches.show', $news->branch_id) }}">{{ $news->branch->name ?? 'Không có' }}</a></span>
                                            <span class="post-on has-dot">{{ $news->created_at }}</span>
                                            <span class="post-on has-dot">3 phút đọc</span>
                                        </div>
                                        <div class="social-icons single-share">
                                            <ul class="text-grey-5 d-inline-block">
                                                <li class="mr-5"><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-bookmark.svg') }}" alt=""></a></li>
                                                <li><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart-2.svg') }}" alt=""></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($news->avatar)
                            <figure class="single-thumbnail">
                                <img style="width: 100%; height: 500px;" src="{{ asset('storage/' . $news->avatar) }}" alt="{{ $news->name }}">
                            </figure>
                        @endif

                        <div class="single-content">
                            <div class="row">
                                <div class="col-xl-10 col-lg-12 m-auto">

                                    {!! $news->content !!}

                                    <!--Entry bottom-->
                                    <div class="entry-bottom mt-50 mb-30">
                                        <div class="social-icons single-share">
                                            <ul class="text-grey-5 d-inline-block">
                                                <li><strong class="mr-10">Chia sẻ:</strong></li>
                                                <li class="social-facebook"><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a></li>
                                                <li class="social-twitter"><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a></li>
                                                <li class="social-instagram"><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a></li>
                                                <li class="social-linkedin"><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!--Author box (optional: nếu có user viết tin thì dùng thêm quan hệ)-->
                                    <div class="author-bio p-30 mt-50 border-radius-15 bg-white">
                                        <div class="author-image mb-30 d-flex">
                                            <a href="#">
                                                <img src="{{ asset('storage/' . ($news->branch->avatar ?? 'default.png')) }}" alt="" class="avatar" style="width: 80px; height: 80px; border-radius: 50%; ">
                                            </a>
                                            <div class="author-infor ml-20">
                                                <h5 class="mb-5"><a class="text-dark" href="{{ route('customer.branches.show', $news->branch_id) }}">{{ $news->branch->name ?? 'Chi nhánh không xác định' }}</a></h5>
                                                <p class="mb-0 text-muted font-xs">
                                                    <span class="mr-10"><i class="fi-rs-marker mr-5"></i> {{ $news->branch->address ?? 'Địa chỉ không có' }}</span><br>
                                                    <span class="mr-10"><i class="fi-rs-phone mr-5"></i> {{ $news->branch->phone ?? 'SĐT không có' }}</span><br>
                                                    <span class="mr-10"><i class="fi-rs-envelope mr-5"></i> {{ $news->branch->email ?? 'Email không có' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="author-des mt-20">
                                            <p>Bài viết được cung cấp bởi chi nhánh <strong>{{ $news->branch->name ?? 'không xác định' }}</strong>. Mọi thắc mắc xin liên hệ trực tiếp với chi nhánh qua số điện thoại hoặc email bên trên.</p>
                                        </div>
                                    </div>
                                    <!-- end Author box -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-50">
                <div class="col-9 m-auto">
                    <h2 class="section-title style-1 mb-30">Tin Tức Mới</h2>
                </div>
                <div class="col-lg-9 m-auto">
                    <div class="loop-grid">
                        <div class="row">
                            @foreach ($newsList as $item)
                                <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                    <div class="post-thumb">
                                        <a href="{{ route('customer.news.show', $item->id) }}">
                                            <img style="width: 100%; height: 251px;" class="border-radius-15" src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}" />
                                        </a>
                                    </div>
                                    <div class="entry-content-2">
                                        <h6 class="mb-10 font-sm">
                                            <a class="entry-meta text-muted" href="{{ route('customer.branches.show', $item->branch_id) }}">{{ $item->branch->name ?? 'N/A' }}</a>
                                        </h6>
                                        <h4 class="post-title mb-15 product-name">
                                            <a href="{{ route('customer.news.show', $item->id) }}">{{ $item->name }}</a>
                                        </h4>
                                        <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                            <div>
                                                <span class="entry-meta text-muted">{{ $item->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
