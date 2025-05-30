@extends('customer.layouts.app')
@section('title', 'Giỏ Hàng')

@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Giỏ Hàng
            </div>
        </div>
    </div>

    <div class="container mb-20 mt-20">
        <div class="row">
            <div class="col-lg-12 mb-40">
                <h1 class="heading-2 mb-10">Giỏ Hàng</h1>
                @php
                    $cart = session('cart', []);
                    $total = 0;
                @endphp
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">Hiện có <span class="text-brand">{{ count($cart) }}</span> sản phẩm trong giỏ hàng!</h6>
                    <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Xóa toàn bộ?</a></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"></label>
                                </th>
                                <th scope="col" colspan="2">Sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col" class="end text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @forelse ($cart as $productId => $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                    $isDiscounted = session('discount_percent', 0) > 0 && session('discount_branch') == $item['branch_id'];
                                @endphp
                                <tr class="pt-30" data-product-id="{{ $productId }}">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img style="width: 118px; height: 118px;" src="{{ asset('storage/' . $item['avatar']) }}" alt="#"></td>
                                    <td class="product-des product-name pt-65">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="{{ route('customer.products.show', $productId) }}">{{ $item['name'] }}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if ($isDiscounted)
                                            <h4 class="text-body">{{ number_format($item['original_price'], 0, ',', '.') }}đ</h4>
                                        @else
                                            <h4 class="text-body">{{ number_format($item['price'], 0, ',', '.') }}đ</h4>
                                        @endif
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" class="qty-val" value="{{ $item['quantity'] }}" min="1">
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if ($isDiscounted)
                                            <h4 class="text-brand">
                                                {{ number_format($item['original_price'] * $item['quantity'], 0, ',', '.') }}đ 
                                            </h4>
                                        @else
                                            <h4 class="text-brand">
                                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ 
                                            </h4>
                                        @endif
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="#" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Giỏ hàng của bạn đang trống.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a href="{{ route('customer.products.index') }}" class="btn "><i class="fi-rs-arrow-left mr-10"></i>Tiếp tục mua sắm</a>
                    {{-- <button class="btn"><i class="fi-rs-refresh mr-10"></i>Cập nhật giỏ hàng</button> --}}
                    @if(count($cart) > 0)
                        <a href="{{ route('customer.orders.store') }}" class="btn ">Đặt Hàng<i class="fi-rs-sign-out ml-15"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Cập nhật số lượng
    document.querySelectorAll('.qty-up, .qty-down').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const input = this.closest('.detail-qty').querySelector('input.qty-val');
            const newQuantity = this.classList.contains('qty-up') ? parseInt(input.value) + 1 : Math.max(1, parseInt(input.value) - 1);
            input.value = newQuantity;

            const productId = this.closest('tr').dataset.productId;

            updateCartQuantity(productId, newQuantity, this.closest('tr'));
        });
    });

    // Xóa sản phẩm
    document.querySelectorAll('.action a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            const productId = row.dataset.productId;

            fetch('{{ route("customer.carts.destroy") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.product_id) {
                    row.remove();
                }
            });
        });
    });

    function updateCartQuantity(productId, quantity, row) {
        fetch('{{ route("customer.carts.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        })
        .then(async response => {
            const data = await response.json();
            
            if (response.ok) {
                row.querySelector('.text-brand').textContent = data.subtotal + 'đ';
                document.querySelector('#cart-total').textContent = data.total + 'đ';
            } else if (response.status === 422 && data.error) {
                const input = row.querySelector('input.qty-val');
                input.value = data.max_quantity;

                Swal.fire({
                    icon: 'warning',
                    title: 'Không đủ hàng!',
                    text: data.error,
                    confirmButtonText: 'Đã hiểu'
                });
            }
        });
    }
});
</script>
@endsection
