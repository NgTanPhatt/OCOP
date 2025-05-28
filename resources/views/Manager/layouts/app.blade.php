<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/imgs/theme/favicon.svg') }}" />
        <!-- Template CSS -->
        <script src="{{ asset('backend/assets/js/vendors/color-modes.js') }}"></script>
        <link href="{{ asset('backend/assets/css/main.css?v=6.0') }}" rel="stylesheet" type="text/css" />
    </head>

    <body style="font-family: system-ui;">
        <div class="screen-overlay"></div>
        <aside class="navbar-aside" id="offcanvas_aside">
            <div class="aside-top">
                <a href="{{ route('manager.dashboard.index') }}" class="brand-wrap">
                    <img src="{{ asset('backend/assets/imgs/theme/logo.svg') }}" class="logo" alt="Nest Dashboard" />
                </a>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
            <ul class="menu-aside">
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.dashboard.index') }}">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Trang Chủ</span>
                    </a>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.branches.index') }}">
                        <i class="icon material-icons md-store"></i>
                        <span class="text">Cừa hàng</span>
                    </a>
                </li>
                @endif
                <li class="menu-item has-submenu">
                    <a class="menu-link" href="{{ route('manager.products.index') }}">
                        <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Sản phẩm</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('manager.products.index') }}">Danh sách sản phẩm</a>
                        <a href="{{ route('manager.categories.index') }}">Danh mục</a>
                        <a href="{{ route('manager.brands.index') }}">Thương hiệu</a>
                        <a href="{{ route('manager.inventories.index') }}">Kho hàng</a>
                    </div>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.orders.index') }}">
                        <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Đơn hàng</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.discounts.index') }}">
                        <i class="icon material-icons md-local_offer"></i>
                        <span class="text">Khuyến mãi</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.users.index') }}">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Người dùng</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.reviews.index') }}">
                        <i class="icon material-icons md-rate_review"></i>
                        <span class="text">Đánh Giá</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('manager.news.index') }}">
                        <i class="icon material-icons md-article"></i>
                        <span class="text">Tin tức</span>
                    </a>
                </li>
            </ul>
                <hr />
                <ul class="menu-aside">
                    @if(auth()->user()->role == 'admin')
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('manager.config.index') }}">
                        <i class="icon material-icons md-build"></i>
                        <span class="text">Cấu Hình</span>
                        </a>
                    </li>
                    @else
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('manager.config.index') }}">
                        <i class="icon material-icons md-store"></i>
                        <span class="text">Cửa Hàng</span>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('manager.profile.index') }}">
                        <i class="icon material-icons md-settings"></i> <!-- Hoặc md-edit -->
                        <span class="text">Đổi Thông Tin</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('manager.login.logout') }}">
                        <i class="icon material-icons md-exit_to_app"></i> <!-- Hoặc md-logout -->
                        <span class="text"> Đăng Xuất </span>
                        </a>
                    </li>
                </ul>
                <br />
                <br />
            </nav>
        </aside>
        <main class="main-wrap">
            <header class="main-header navbar">
                <div class="col-search">

                </div>
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">
                        <li class="nav-item">
                            @if(auth()->user()->role == 'admin')
                                <a class="nav-link btn-icon" target="_blank" href="{{ route('customer.home.index') }}"> <i class="material-icons md-language"></i> </a>
                            @else
                                @php
                                    $branch = auth()->user()->branch;
                                @endphp
                                <a class="nav-link btn-icon" target="_blank" href="{{ route('customer.branches.show', auth()->user()->branch->id) }}"> <i class="material-icons md-language"></i> </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-icon darkmode"  href="#"> <i class="material-icons md-nights_stay"></i> </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                        </li>
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{ asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="{{ route('manager.profile.index') }}"><i class="material-icons md-perm_identity"></i>Đổi Thông Tin</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('manager.login.logout') }}"><i class="material-icons md-exit_to_app"></i>Đăng Xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
            <section class="content-main">
            @yield('content')
            </section>
        </main>
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/select2.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/chart.js') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=6.0') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/custom-chart.js') }}" type="text/javascript"></script>
    </body>
</html>
