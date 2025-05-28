@extends('manager.layouts.app')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
<div class="content-header">
    <h2 class="content-title">Chi tiết đơn hàng #{{ $order->id }}</h2>
    <a href="{{ route('manager.orders.index') }}" class="btn btn-light">Quay lại</a>
</div>

<!-- Thông tin đơn hàng -->
<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title">Thông tin đơn hàng</h4>
        <p><strong>Khách hàng:</strong> {{ $order->user->fullname }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Thanh toán:</strong> {{ $order->payment === 'bank' ? 'Chuyển khoản' : 'Tiền mặt' }}</p>
        <p><strong>Trạng thái:</strong> 
            @switch($order->status)
                @case('pending')
                    Chờ xử lý
                    @break
                @case('confirmed')
                    Đã xác nhận
                    @break
                @case('preparing')
                    Đang chuẩn bị
                    @break
                @case('shipping')
                    Đang giao
                    @break
                @case('delivered')
                    Đã giao
                    @break
                @case('completed')
                    Hoàn thành
                    @break
                @case('cancelled')
                    Đã hủy
                    @break
                @case('refunded')
                    Đã hoàn tiền
                    @break
                @default
                    Chưa rõ
            @endswitch
        </p>
        <p><strong>Thành tiền:</strong> {{ number_format($order->amount, 0, ',', '.') }} đ</p> 
        @if($order->discount_id != null)
            <p><strong>Các sản phẩm đã áp mã giảm </strong> {{ number_format($order->discount->percent, 0, ',', '.') }}%</p>
        @endif
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

        <div class="mt-4">
            @if(auth()->user()->role != 'admin')
                <form action="{{ route('manager.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex">
                        <div class="me-2">
                            <label for="status" class="form-label">Trạng thái đơn hàng:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Đang chuẩn bị</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền</option>
                            </select>
                        </div>
                        <div>
                            <label for="payment_status" class="form-label">Thanh toán:</label>
                            <select name="payment_status" id="payment_status" class="form-select">
                                <option value="cod" {{ $order->payment == 'cod' ? 'selected' : '' }}>Tiền mặt</option>
                                <option value="bank" {{ $order->payment == 'bank' ? 'selected' : '' }}>Chuyển khoản</option>
                            </select>
                        </div>
                        <div class="ms-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<!-- Danh sách sản phẩm -->
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách sản phẩm</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($item->product->avatar)
                                <img src="{{ asset('storage/' . $item->product->avatar) }}" alt="Image" style="width: 60px; height: 60px;">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->product->price, 0, ',', '.') }} đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @if($order->discount_id != null)
                                <del>{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} đ</del>
                                <br>
                                {{ number_format(($item->quantity * $item->product->price) - $order->discount->percent * ($item->quantity * $item->product->price) / 100, 0, ',', '.') }} đ
                            @else
                                {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} đ
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
