@extends('customer.layouts.app')
@section('title', 'Khách Hàng')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Khách Hàng
            </div>
        </div>
    </div>
    <div class="page-content pt-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Đơn Đặt Hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Đổi Thông Tin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('customer.login.logout') }}"><i class="fi-rs-sign-out mr-10"></i>Đăng Xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content">
                                <div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Danh Sách</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Mã</th>
                                                            <th class="text-center">Ngày Đặt</th>
                                                            <th class="text-center">Trạng Thái</th>
                                                            <th class="text-center">Tổng Tiền</th>
                                                            <th class="text-center">Hành Động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="line-height: 50px;">
                                                        @forelse ($orders as $order)
                                                            <tr>
                                                                <td class="text-center">#{{ $order->id }}</td>
                                                                <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                                                                <td class="text-center">
                                                                    @php
                                                                        $status = [
                                                                            'pending' => ['label' => 'Chờ xác nhận', 'class' => 'badge bg-secondary'],
                                                                            'confirmed' => ['label' => 'Đã xác nhận', 'class' => 'badge bg-primary'],
                                                                            'preparing' => ['label' => 'Đang chuẩn bị', 'class' => 'badge bg-info text-dark'],
                                                                            'shipping' => ['label' => 'Đang giao hàng', 'class' => 'badge bg-warning text-dark'],
                                                                            'delivered' => ['label' => 'Đã giao', 'class' => 'badge bg-success'],
                                                                            'completed' => ['label' => 'Hoàn thành', 'class' => 'badge bg-success'],
                                                                            'cancelled' => ['label' => 'Đã hủy', 'class' => 'badge bg-danger'],
                                                                            'refunded' => ['label' => 'Đã hoàn tiền', 'class' => 'badge bg-dark'],
                                                                        ][$order->status] ?? ['label' => 'Không xác định', 'class' => 'badge bg-light text-dark'];
                                                                    @endphp
                                                                    <span class="{{ $status['class'] }}">{{ $status['label'] }}</span>
                                                                </td>
                                                                <td class="text-center">{{ number_format($order->amount + 30000, 0, ',', '.') }}₫</td>
                                                                <td class="text-center"><a href="{{ route('customer.users.orderShow', $order->id) }}" class="btn-small d-block">Xem</a></td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <div class="pagination-area mt-30 mb-5 d-flex justify-content-center">
                                                    {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Thông Tin Tài Khoản</h5>
                                        </div>
                                        <div class="card-body">
                                        <form method="post" action="{{ route('customer.users.update') }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Họ tên <span class="required">*</span></label>
                                                        <input required class="form-control" name="fullname" type="text" value="{{ old('fullname', auth()->user()->fullname) }}" />
                                                        @error('fullname')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Số điện thoại <span class="required">*</span></label>
                                                        <input required class="form-control" name="phone" type="text" value="{{ old('phone', auth()->user()->phone) }}" />
                                                        @error('phone')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input required class="form-control" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" />
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    
                                                    <p>Đổi mật khẩu</p>
                                                    <hr>
                                                    <div class="form-group col-md-12">
                                                        <label>Mật khẩu hiện tại <span class="required">*</span></label>
                                                        <input class="form-control" name="current_password" type="password" />
                                                        @error('current_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Mật khẩu mới</label>
                                                        <input class="form-control" name="new_password" type="password" />
                                                        @error('new_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Xác nhận mật khẩu mới</label>
                                                        <input class="form-control" name="new_password_confirmation" type="password" />
                                                        @error('new_password_confirmation')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold">Cập Nhật</button>
                                                    </div>
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
        </div>
    </div>
<style>
    .form-group input{
        height: 40px;
    }

    button.submit, button[type=submit]{
        padding: 10px 15px;
    }
</style>
@endsection
