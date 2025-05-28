@extends('manager.layouts.app')
@section('title', 'Cập Nhật Trạng Thái Đơn Hàng')
@section('content')
<div class="content-header">
    <h2 class="content-title">Cập nhật đơn hàng #{{ $order->id }}</h2>
    <a href="{{ route('manager.orders.index') }}" class="btn btn-light">Quay lại</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('manager.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    @foreach([
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'preparing' => 'Đang chuẩn bị',
                        'shipping' => 'Đang giao',
                        'delivered' => 'Đã giao',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                        'refunded' => 'Hoàn tiền'
                    ] as $key => $value)
                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
