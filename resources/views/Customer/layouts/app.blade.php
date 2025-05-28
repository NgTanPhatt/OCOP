<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=6.0') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body style="font-family: system-ui;">
    <header class="header-area header-style-1  header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block" style="background-color: #3bb77e;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="{{ route('manager.login.index') }}"><strong>Kênh Bán Hàng</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center d-none">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li><a href="{{ route('customer.news.index') }}"><strong>Tin Tức</strong></a></li>
                                <li><a href="{{ route('customer.branches.index') }}"><strong>Gian Hàng</strong></a></li>
                                <li><a href="{{ route('customer.discounts.index') }}"><strong>Mã Giảm Giá</strong></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('customer.home.index') }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2" style="justify-items: anchor-center;">
                            <form action="{{ route('customer.products.index') }}">
                                <input type="text" name="name" placeholder="Nhập tên sản phẩm" style="max-width: 100%;" />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    @php
                                        $cart = session('cart', []);
                                        $productCount = count($cart);
                                    @endphp

                                    <a class="mini-cart-icon" href="{{ route('customer.carts.index') }}">
                                        <img alt="Giỏ hàng" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                        <span class="pro-count blue">{{ $productCount }}</span>
                                    </a>
                                    <a href="{{ route('customer.carts.index') }}"><span class="lable">Giỏ Hàng</span></a>
                                </div>
                                @if(auth()->user() && auth()->user()->role == 'customer')
                                <div class="header-action-icon-2">
                                    <a href="{{ route('customer.users.index') }}">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('customer.users.index') }}"><span class="lable">Tài Khoản</span></a>
                                </div>
                                @else
                                <div class="header-action-icon-2">
                                    <a href="{{ route('customer.login.index') }}">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('customer.login.index') }}"><span class="lable">Đăng Nhập</span></a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('customer.home.index') }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a style="cursor: pointer; line-height: 44px; border-radius: 5px; padding: 0 20px; font-family: sans-serif; font-size: 14px; background-color: #3BB77E;" href="{{ route('customer.products.index') }}">
                                <span class="fi-rs-apps"></span> <span class="et">Tất Cả</span> Sản Phẩm
                            </a>
                            @php
                                use App\Models\Category;
                                $commom_categories = Category::all();
                            @endphp
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul class="d-flex gap-4 align-items-center list-unstyled mb-0 menu_main_layout">
                                <li>
                                    <a href="{{ route('customer.home.index') }}" class="text-decoration-none">
                                        <i class="fas fa-home"></i>
                                        <small> Trang Chủ</small>
                                    </a>
                                </li>    

                                <li>
                                    <a href="{{ route('customer.about.index') }}" class="text-decoration-none">
                                        <i class="fas fa-check-circle"></i>
                                        <small> Hàng chất lượng</small>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('customer.about.index') }}" class="text-decoration-none">
                                        <i class="fas fa-shield-alt"></i>
                                        <small> 100% hàng thật</small>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('customer.about.index') }}" class="text-decoration-none">
                                        <i class="fas fa-exchange-alt"></i>
                                        <small> 30 ngày đổi trả</small>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('customer.about.index') }}" class="text-decoration-none">
                                        <i class="fas fa-shipping-fast"></i>
                                        <small> Giao nhanh</small>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('customer.about.index') }}" class="text-decoration-none">
                                        <i class="fas fa-tags"></i>
                                        <small> Giá siêu rẻ</small>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>

                    <div class="hotline d-none d-lg-flex">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone-white.svg') }}"
                            alt="hotline" />
                        <p>1900 - 888<span>24/7 Trung tâm hỗ trợ</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                @php
                                    $cart = session('cart', []);
                                    $productCount = count($cart);
                                @endphp

                                <a class="mini-cart-icon" href="{{ route('customer.carts.index') }}">
                                    <img alt="Giỏ hàng" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                    <span class="pro-count blue">{{ $productCount }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('customer.home.index') }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="{{ route('customer.products.index') }}">
                        <input type="text" name="name" placeholder="Nhập tên sản phẩm" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li>
                                <a href="{{ route('customer.home.index') }}">Trang Chủ</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Liên Hệ </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('customer.login.index') }}"><i class="fi-rs-user"></i>Đăng Nhập / Đăng Ký </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2024 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->
    <main class="main">
        @yield('content')
    </main>
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Giá tốt & ưu đãi</h3>
                            <p>Đơn hàng từ $50 trở lên</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Miễn phí giao hàng</h3>
                            <p>Dịch vụ 24/7 tuyệt vời</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Ưu đãi hàng ngày</h3>
                            <p>Khi bạn đăng ký</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Đa dạng mặt hàng</h3>
                            <p>Khuyến mãi lớn</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Đổi trả dễ dàng</h3>
                            <p>Trong vòng 30 ngày</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Giao hàng an toàn</h3>
                            <p>Trong vòng 30 ngày</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="main" style="background-color: #3bb77e;">
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="footer-link-widget col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0">
                            <div class="logo mb-30">
                                <a href="{{ route('customer.home.index') }}" class="mb-15"><img
                                        src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="logo" /></a>
                                <p class="font-lg text-heading">Mẫu giao diện cửa hàng thực phẩm tuyệt vời</p>
                            </div>
                            <ul class="contact-infor">
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Địa
                                        chỉ:</strong> <span>5171 W Campbell Ave, Kent, Utah 53127, Hoa Kỳ</span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Gọi cho chúng
                                        tôi:</strong><span>(+91) - 540-025-124553</span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                        alt="" /><strong>Email:</strong><span>sale@Nest.com</span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" /><strong>Giờ làm
                                        việc:</strong><span>10:00 - 18:00, Thứ 2 - Thứ 7</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Công ty</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Thông tin giao hàng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản & điều kiện</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <li><a href="#">Trung tâm hỗ trợ</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Tài khoản</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Đăng nhập</a></li>
                            <li><a href="#">Giỏ hàng</a></li>
                            <li><a href="#">Danh sách yêu thích</a></li>
                            <li><a href="#">Theo dõi đơn hàng</a></li>
                            <li><a href="#">Trung tâm hỗ trợ</a></li>
                            <li><a href="#">Chi tiết vận chuyển</a></li>
                            <li><a href="#">So sánh sản phẩm</a></li>
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Doanh nghiệp</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">Trở thành nhà bán</a></li>
                            <li><a href="#">Chương trình liên kết</a></li>
                            <li><a href="#">Kinh doanh nông sản</a></li>
                            <li><a href="#">Tuyển dụng nông trại</a></li>
                            <li><a href="#">Nhà cung cấp</a></li>
                            <li><a href="#">Truy cập dễ dàng</a></li>
                            <li><a href="#">Chương trình khuyến mãi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2024, <strong class="text-white">Nest</strong> - Mẫu giao diện thương
                        mại điện tử HTML<br />Mọi quyền được bảo lưu</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex mr-30">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                        <p>1900 - 6666<span>8:00 - 22:00</span></p>
                    </div>
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                        <p>1900 - 8888<span>Trung tâm hỗ trợ 24/7</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Theo dõi chúng tôi</h6>
                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                                alt="" /></a>
                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="chatbox" class="chatbox">
        <div class="chatbox-header" onclick="toggleChatbox()" style="cursor: pointer;">
            <span>Hỗ trợ trực tuyến</span>
            <button style="border: none; background-color: transparent; color: #fff;">−</button>
        </div>
        <div class="chatbox-body" id="chatbox-body">
            <div class="chat-message bot">Bạn cần hỏi về sản phẩm gì?</div>
        </div>
        <div class="chatbox-input" id="chatbox-input">
            <input type="text" id="chat-input" placeholder="Tối đa 100 ký tự" onkeypress="sendOnEnter(event)">
            <button onclick="sendMessage()">Gửi</button>
        </div>
    </div>
    <style>
        .chatbox {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 300px;
            max-height: 500px; /* Tăng từ 400px lên 500px */
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            overflow: hidden;
            font-family: system-ui;
            z-index: 9999;
        }

        .chatbox-header {
            background: #3bb77e;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbox-body {
            height: 300px; /* Tăng từ 200px lên 300px */
            overflow-y: auto;
            padding: 10px;
            background-color: #f8f8f8;
        }

        .chatbox-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        .chatbox-input input {
            flex: 1;
            padding: 10px;
            border: none;
            outline: none;
        }

        .chatbox-input button {
            background: #3bb77e;
            color: white;
            border: none;
            padding: 0 15px;
            cursor: pointer;
        }

        .chat-message {
            margin-bottom: 8px;
            padding: 8px 10px;
            border-radius: 8px;
            max-width: 80%;
        }

        .chat-message.bot {
            background-color: #e0f7ea;
            align-self: flex-start;
        }

        .chat-message.user {
            background-color: #d3eafd;
            align-self: flex-end;
            text-align: right;
        }

        footer.main {
            color: #fff;
        }

        footer.main a {
            color: #fff;
        }

        footer.main a:hover {
            color: #d1d1d1;
        }

        footer.main h4,
        footer.main h6,
        footer.main p,
        footer.main span,
        footer.main li,
        footer.main strong {
            color: #fff;
        }

        .header-top {
            color: #fff;
        }

        .header-top a,
        .header-top strong,
        .header-top li {
            color: #fff;
        }

        .header-top a:hover {
            color: #d1d1d1;
        }

        .product-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            max-width: 100%;
            /* hoặc giới hạn cụ thể như 250px */
        }
        .chat-message.typing {
            font-style: italic;
            color: #666;
        }
        .main-menu > nav > ul > li > a{
            color: #3BB77E;
            font-weight: bold;
            text-transform: uppercase;
            font-size: clamp(14px, 10px, 16px);
        }

        .main-menu > nav > ul > li > a i {
            font-size: clamp(14px, 10px, 16px);
            position: relative;
            margin-left: 0px;
        }
    </style>
    <script>
        async function sendMessage() {
            const input = document.getElementById('chat-input');
            let message = input.value.trim();

            // Kiểm tra độ dài tin nhắn
            if (!message) return;
            if (message.length > 100) {
                alert('Vui lòng nhập tối đa 100 ký tự.');
                return;
            }

            const chatBody = document.getElementById('chatbox-body');

            // Hiển thị tin nhắn người dùng
            const userMsg = document.createElement('div');
            userMsg.className = 'chat-message user';
            userMsg.innerText = message;
            chatBody.appendChild(userMsg);
            chatBody.scrollTop = chatBody.scrollHeight;

            input.value = '';

            // Hiển thị hiệu ứng "Đang nhập..."
            const typingMsg = document.createElement('div');
            typingMsg.className = 'chat-message bot typing';
            typingMsg.innerText = 'Đang nhập...';
            chatBody.appendChild(typingMsg);
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                const response = await fetch(`http://127.0.0.1:8000/test-chat?question=${encodeURIComponent(message)}`);
                const data = await response.text();

                // Xoá hiệu ứng đang nhập
                typingMsg.remove();

                // Hiển thị phản hồi từ server
                const botMsg = document.createElement('div');
                botMsg.className = 'chat-message bot';
                try {
                    const jsonData = JSON.parse(data);
                    botMsg.innerText = jsonData.answer || "Hệ thống bận!";
                } catch {
                    botMsg.innerText = "Phản hồi không hợp lệ.";
                }

                chatBody.appendChild(botMsg);
                chatBody.scrollTop = chatBody.scrollHeight;
            } catch (error) {
                // Xoá hiệu ứng đang nhập
                typingMsg.remove();

                const errorMsg = document.createElement('div');
                errorMsg.className = 'chat-message bot';
                errorMsg.innerText = 'Lỗi kết nối tới máy chủ.';
                chatBody.appendChild(errorMsg);
                chatBody.scrollTop = chatBody.scrollHeight;

                console.error('Fetch error:', error);
            }
        }

        function sendOnEnter(e) {
            if (e.key === 'Enter') sendMessage();
        }

        function toggleChatbox() {
            const body = document.getElementById('chatbox-body');
            body.style.display = (body.style.display === 'none') ? 'block' : 'none';

            const chatInput = document.getElementById('chatbox-input');
            chatInput.style.display = (chatInput.style.display === 'none') ? 'flex' : 'none';
        }
    </script>
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=6.0') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=6.0') }}"></script>
</body>

</html>