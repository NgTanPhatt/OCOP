<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Đăng Nhập Hệ Thống</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('backend/assets/imgs/theme/favicon.svg') }}">
        <!-- Template CSS -->
        <script src="{{ asset('backend/assets/js/vendors/color-modes.js') }}"></script>
        <link href="{{ asset('backend/assets/css/main.css?v=6.0') }}" rel="stylesheet" type="text/css" />
    </head>

    <body style="background-color: #f8f9fa;">
        <main>
            <section class="content-main mt-200 mb-80">
                <div class="card mx-auto card-login">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Đăng Nhập</h4>
                        <form method="POST" action="{{ route('manager.login.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" placeholder="Email hoặc tài khoản" name="username" type="text" value="{{ old('username') }}" />
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- form-group// -->

                            <div class="mb-3">
                                <input class="form-control" placeholder="Mật khẩu" name="password" type="password" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- form-group// -->

                            <div class="mb-3">
                                <a href="#" class="float-end font-sm text-muted">Quên mật khẩu?</a>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Nhớ tài khoản</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->

                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary w-100 justify-content-center">Đăng Nhập</button>
                            </div>
                            <!-- form-group// -->
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
