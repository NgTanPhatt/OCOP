@extends('Customer.layouts.app')
@section('title', 'Đăng Nhập')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Đăng Nhập
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5 text-center">Đăng Nhập</h1>
                                        <p class="mb-30 text-center">Chưa có tài khoản? <a href="{{ route('customer.login.register') }}">Đăng Ký</a></p>
                                    </div>
                                    <form method="post" action="{{ route('customer.login.submit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="login" value="{{ old('login') }}" placeholder="Email, số điện thoại hoặc tên đăng nhập *" />
                                            @error('login')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Mật khẩu *" />
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" />
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Nhớ mật khẩu</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#">Quên mật khẩu?</a>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-heading btn-block hover-up">Đăng Nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection