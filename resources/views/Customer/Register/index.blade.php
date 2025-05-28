@extends('Customer.layouts.app')
@section('title', 'Đăng Ký')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Đăng Ký
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
                                        <h1 class="mb-5 text-center">Đăng Ký</h1>
                                        <p class="mb-30 text-center">Đã có tài khoản? <a href="{{ route('customer.login.index') }}">Đăng Nhập</a></p>
                                    </div>
                                    <form method="post" action="{{ route('customer.login.registerSubmit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="Họ tên *" />
                                            @error('fullname')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Tên đăng nhập *" />
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email *" />
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại *" />
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Mật khẩu *" />
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu *" />
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-heading btn-block hover-up">Đăng Ký</button>
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
