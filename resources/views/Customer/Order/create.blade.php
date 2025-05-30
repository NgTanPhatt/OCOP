@extends('customer.layouts.app')
@section('title', 'Đặt Hàng')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Đặt Hàng
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-20">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Đặt Hàng</h1>
                <div class="d-flex justify-content-between">
                    @php
                        $cart = session('cart', []);
                        $total = 0;
                    @endphp
                    <h6 class="text-body">Hiện có <span class="text-brand">{{ count($cart) }}</span> sản phẩm trong giỏ hàng!</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="row mb-50">
                    <div class="col-lg-5 mb-sm-15 mb-lg-0 mb-md-3">
                        <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted font-lg">Cần tìm mã giảm giá?</span> <a href="{{ route('customer.discounts.index') }}" class="collapsed font-lg" > Mã Giám Giá</a></span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form method="post" action="{{ route('customer.carts.discount') }}" class="apply-coupon">
                            @csrf
                            <input type="text" name="discount" placeholder="Áp dụng 1 mã giảm giá của 1 shop">
                            <button class="btn btn-md">Sử Dụng</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <h4 class="mb-30">Thông Tin Đặt Hàng</h4>
                    <form method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" required="" value="{{ auth()->user()->fullname }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="phone" required="" placeholder="Số điện thoại nhận hàng *">
                            </div>
                        </div>
                        <h4 class="mb-30 mt-30">Thông Tin Giao Hàng</h4>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <select name="province" id="province" class="form-control" style="background: #fff; border: 1px solid #ececec; height: 64px; box-shadow: none; padding-left: 20px; font-size: 16px; width: 100%;">
                                    <option value="">-- Chọn Tỉnh / Thành Phố --</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <select name="district" id="district" class="form-control" style="background: #fff; border: 1px solid #ececec; height: 64px; box-shadow: none; padding-left: 20px; font-size: 16px; width: 100%;">
                                    <option value="">-- Chọn Quận / Huyện --</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <select name="ward" id="ward" class="form-control" style="background: #fff; border: 1px solid #ececec; height: 64px; box-shadow: none; padding-left: 20px; font-size: 16px; width: 100%;">
                                    <option value="">-- Chọn Xã / Phường --</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="address" required="" placeholder="Địa chỉ *">
                            </div>
                        </div>
                        <input type="hidden" name="province_name" id="province_name">
                        <input type="hidden" name="district_name" id="district_name">
                        <input type="hidden" name="ward_name" id="ward_name">

                        <div class="payment">
                            <!-- <h4 class="mb-30">Payment</h4>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                                </div>
                            </div> -->
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Đặt Hàng<i class="fi-rs-sign-out ml-15"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Giỏ Hàng</h4>
                        <h6 class="text-muted">Tạm Tính</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $productId => $item)
                                    @php
                                        $isDiscounted = session('discount_percent', 0) > 0 && session('discount_branch') == $item['branch_id'];
                                        
                                        if($isDiscounted){
                                            $subtotal = $item['original_price'] * $item['quantity'];
                                        }else{
                                            $subtotal = $item['price'] * $item['quantity'];
                                        }
                                        
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <img style="width: 100%; height: 108px;" src="{{ asset('storage/' . $item['avatar']) }}" alt="{{ $item['name'] }}">
                                        </td>
                                        <td>
                                            <h6 class="w-160 mb-5">
                                                <a href="{{ route('customer.products.show', $productId) }}" class="text-heading">
                                                    {{ $item['name'] }}
                                                </a>
                                            </h6>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">(4)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <strong class="text-muted pl-20 pr-20">x {{ $item['quantity'] }}</strong>
                                        </td>
                                        <td>
                                            @if ($isDiscounted)
                                                <div>
                                                    <del style="color: #888;">{{ number_format($item['original_price'] * $item['quantity'], 0, ',', '.') }}đ</del>
                                                    <br>
                                                    <span class="text-brand">{{ number_format($item['price'], 0, ',', '.') }}đ</span>
                                                </div>
                                            @else
                                                <div>
                                                    <span class="text-brand">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $shipping_fee = 30000;
                                    $discount_percent = session('discount_percent', 0);
                                    $discount_branch = session('discount_branch', null);
                                    $discount_value = session('discount_value', null);

                                    $final_total = $total + $shipping_fee - $discount_value;
                                @endphp

                                <tr>
                                    <td colspan="3" class="text-right"><h6 class="text-heading">Tạm tính ban đầu:</h6></td>
                                    <td><h6 class="text-brand">{{ number_format($total, 0, ',', '.') }}đ</h6></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><h6 class="text-heading">Phí giao hàng:</h6></td>
                                    <td><h6 class="text-brand">+{{ number_format($shipping_fee, 0, ',', '.') }}đ</h6></td>
                                </tr>
                                @if ($discount_percent > 0)
                                <tr>
                                    <td colspan="3" class="text-right"><h6 class="text-heading">Mã giảm giá:</h6></td>
                                    <td><h6 class="text-brand text-danger">-{{ number_format($discount_value, 0, ',', '.') }}đ</h6></td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-right"><h6 class="text-heading">Tổng cộng:</h6></td>
                                    <td><h6 class="text-brand">{{ number_format($final_total, 0, ',', '.') }}đ</h6></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
document.addEventListener('DOMContentLoaded', () => {
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');

    const provinceNameInput = document.getElementById('province_name');
    const districtNameInput = document.getElementById('district_name');
    const wardNameInput = document.getElementById('ward_name');

    // Load danh sách tỉnh
    fetch('https://provinces.open-api.vn/api/p/')
        .then(response => response.json())
        .then(data => {
            data.forEach(province => {
                provinceSelect.innerHTML += `<option value="${province.code}" data-name="${province.name}">${province.name}</option>`;
            });
        });

    provinceSelect.addEventListener('change', function () {
        const provinceCode = this.value;
        const selectedOption = this.options[this.selectedIndex];
        provinceNameInput.value = selectedOption.dataset.name || '';

        districtSelect.innerHTML = `<option value="">-- Chọn Quận / Huyện --</option>`;
        wardSelect.innerHTML = `<option value="">-- Chọn Xã / Phường --</option>`;
        districtNameInput.value = '';
        wardNameInput.value = '';

        if (!provinceCode) return;

        fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`)
            .then(response => response.json())
            .then(data => {
                data.districts.forEach(district => {
                    districtSelect.innerHTML += `<option value="${district.code}" data-name="${district.name}">${district.name}</option>`;
                });
            });
    });

    districtSelect.addEventListener('change', function () {
        const districtCode = this.value;
        const selectedOption = this.options[this.selectedIndex];
        districtNameInput.value = selectedOption.dataset.name || '';

        wardSelect.innerHTML = `<option value="">-- Chọn Xã / Phường --</option>`;
        wardNameInput.value = '';

        if (!districtCode) return;

        fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`)
            .then(response => response.json())
            .then(data => {
                data.wards.forEach(ward => {
                    wardSelect.innerHTML += `<option value="${ward.code}" data-name="${ward.name}">${ward.name}</option>`;
                });
            });
    });

    wardSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        wardNameInput.value = selectedOption.dataset.name || '';
    });
});
</script>
@endsection