@extends('Customer.layouts.app')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Chi Tiết Đơn Hàng
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">
                           
                                </th>
                                <th scope="col">Hình Ảnh</th>
                                <th class="text-center">Tên Sản Phẩm</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $orderDetail)
                                <tr>
                                    <td class="custome-checkbox start pl-30">
                           
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="{{ route('customer.products.show', $orderDetail->product->id) }}">
                                            <img style="width: 118px; height: 118px;" src="{{ asset('storage/' . $orderDetail->product->avatar) }}" alt="" />
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('customer.products.show', $orderDetail->product->id) }}"><h6 class="product-name text-heading">{{ $orderDetail->product->name }}</h6></a>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="text-center"><span class="amount">{{ number_format($orderDetail->product->price, 0, ',', '.') }}₫</span></td>
                                    <td class="text-center">{{ $orderDetail->quantity }}</td>
                                    <td class="text-center"><span class="amount">{{ number_format($orderDetail->quantity * $orderDetail->product->price, 0, ',', '.') }}₫</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a href="{{ route('customer.users.index') }}" class="btn "><i class="fi-rs-arrow-left mr-10"></i>Quay Lại</a>

                </div>
            </div>
        </div>
    </div>

@endsection