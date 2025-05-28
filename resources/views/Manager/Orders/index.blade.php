@extends('manager.layouts.app')
@section('title', 'Quản Lý Đơn Hàng')

@section('content')
    <div class="content-header">
        <h2 class="content-title">Danh sách đơn hàng</h2>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <form action="{{ route('manager.orders.index') }}" method="GET" class="row gx-3 gy-2 align-items-end">
                <div class="col-lg-3">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" name="search" class="form-control" placeholder="Tên hoặc SĐT"
                        value="{{ request('search') }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Tình trạng</label>
                    <select name="status" class="form-select">
                        <option value="">-- Tất cả --</option>
                        @php
                            $statusLabels = [
                                'pending' => 'Chờ xác nhận',
                                'confirmed' => 'Đã xác nhận',
                                'preparing' => 'Đang chuẩn bị',
                                'shipping' => 'Đang giao',
                                'delivered' => 'Đã giao',
                                'completed' => 'Hoàn tất',
                                'cancelled' => 'Đã hủy',
                                'refunded' => 'Đã hoàn tiền',
                            ];
                        @endphp
                        @foreach($statusLabels as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Từ ngày</label>
                    <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Đến ngày</label>
                    <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>

                <div class="col-12 mt-3 text-end">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    <a href="{{ route('manager.orders.index') }}" class="btn btn-secondary">Đặt lại</a>
                </div>
            </form>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Người đặt</th>
                        <th>SĐT</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Thời gian</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->user->fullname ?? 'Không có' }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ number_format($order->amount, 0, ',', '.') }}₫</td>
                            @php
                                $paymentTypes = [
                                    'bank' => 'Chuyển khoản',
                                    'cod' => 'Tiền mặt',
                                ];

                                $statuses = [
                                    'pending' => 'Chờ xác nhận',
                                    'confirmed' => 'Đã xác nhận',
                                    'preparing' => 'Đang chuẩn bị',
                                    'shipping' => 'Đang giao',
                                    'delivered' => 'Đã giao',
                                    'completed' => 'Hoàn tất',
                                    'cancelled' => 'Đã hủy',
                                    'refunded' => 'Đã hoàn tiền'
                                ];
                            @endphp

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $paymentTypes[$order->payment] ?? $order->payment }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $statuses[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('manager.orders.show', $order->id) }}" class="btn btn-sm btn-light" title="Chi tiết">
                                    <i class="material-icons md-visibility"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Không có đơn hàng nào phù hợp.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pagination-area mt-15 mb-50">
        <nav aria-label="Page navigation">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>
    </div>
@endsection
