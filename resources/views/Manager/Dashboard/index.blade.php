@extends('Manager.layouts.app')
@section('title', 'Hệ Thống Quản Lý')
@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard</h2>
            <p>Thống kê thông tin hệ thống</p>
        </div>
        <div>
            <!-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> -->
        </div>
    </div>
    @if(auth()->user()->role == 'admin')
        <div class="row">
            {{-- Cửa Hàng --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-store"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Cửa Hàng</h6>
                            <span>{{ number_format($stats['branches']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['branches']['new'] }} trong tháng này</span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Sản Phẩm --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light">
                            <i class="text-success material-icons md-shopping_bag"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Sản Phẩm</h6>
                            <span>{{ number_format($stats['products']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['products']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Chuyên Mục --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light">
                            <i class="text-warning material-icons md-qr_code"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Chuyên Mục</h6>
                            <span>{{ number_format($stats['categories']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['categories']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Khuyến Mãi --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light">
                            <i class="text-info material-icons md-shopping_basket"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Khuyến Mãi</h6>
                            <span>{{ number_format($stats['discounts']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['discounts']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Người Dùng --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Người Dùng</h6>
                            <span>{{ number_format($stats['users']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['users']['new'] }} trong tháng này</span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Đánh Giá --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light">
                            <i class="text-success material-icons md-rate_review"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Đánh Giá</h6>
                            <span>{{ number_format($stats['reviews']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['reviews']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Tin Tức --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light">
                            <i class="text-warning material-icons md-article"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Tin Tức</h6>
                            <span>{{ number_format($stats['news']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['news']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Đơn Hàng --}}
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light">
                            <i class="text-info material-icons md-shopping_cart"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Đơn Hàng</h6>
                            <span>{{ number_format($stats['orders']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['orders']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Thống Kê Tổng Hợp</h5>
                        <canvas id="summaryChart" height="130px"></canvas>
                    </article>
                </div>

            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Cửa hàng mới</h5>
                        <div class="new-member-list">
                            @foreach ($latestStores as $branch)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $branch->avatar) }}" alt="" class="avatar" />
                                        <div>
                                            <h6>{{ $branch->name }}</h6>
                                            <p class="text-muted font-xs">{{ $branch->address }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('customer.branches.show', $branch->id) }}" target="_blank" class="btn btn-xs"><i class="material-icons md-visibility"></i> Xem</a>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            {{-- Sản Phẩm --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light">
                            <i class="text-success material-icons md-shopping_bag"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Sản Phẩm</h6>
                            <span>{{ number_format($stats['products']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['products']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Khuyến Mãi --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light">
                            <i class="text-info material-icons md-shopping_basket"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Khuyến Mãi</h6>
                            <span>{{ number_format($stats['discounts']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['discounts']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Người Dùng --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Khách Hàng</h6>
                            <span>{{ number_format($stats['users']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['users']['new'] }} trong tháng này</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Doanh thu --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light">
                            <i class="text-warning material-icons md-article"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Doanh Thu</h6>
                            <span>{{ number_format($stats['revenue']['total'], 0) }}đ</span>
                            <span class="text-sm"> Doanh thu trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Đánh Giá --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-success-light">
                            <i class="text-success material-icons md-rate_review"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Đánh Giá</h6>
                            <span>{{ number_format($stats['reviews']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['reviews']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>

            {{-- Đơn Hàng --}}
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light">
                            <i class="text-info material-icons md-shopping_cart"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Đơn Hàng</h6>
                            <span>{{ number_format($stats['orders']['total'], 0) }}</span>
                            <span class="text-sm"> +{{ $stats['orders']['new'] }} trong tháng này </span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Thống Kê Tổng Hợp</h5>
                        <canvas id="summaryChart2" height="153px"></canvas>
                    </article>
                </div>

            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Đơn Hàng Mới</h5>
                        <div class="new-member-list">
                            @foreach ($latestOrders as $order)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6>{{ $order->user->fullname }}</h6>
                                            <p class="text-muted font-xs">{{ number_format($order->amount) }}đ</p>
                                            <p>{{ $order->created_at }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('manager.orders.show', $order->id) }}" class="btn btn-xs"><i class="material-icons md-visibility"></i> Xem</a>
                                </div>
                            @endforeach
                        </div>
                    </article>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Thống Kê Doanh Thu</h5>
                        <canvas id="summaryChart3" height="100px"></canvas>
                    </article>
                </div>
            </div>
        </div>
    @endif
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(auth()->user()->role == 'admin')
<script>
    const ctx = document.getElementById('summaryChart').getContext('2d');

    const summaryChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
            datasets: [
                {
                    label: 'Cửa Hàng',
                    data: @json($storeCounts),
                    borderColor: 'rgba(0, 123, 255, 1)',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Đơn Hàng',
                    data: @json($orderCounts),
                    borderColor: 'rgba(40, 167, 69, 1)',
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Sản Phẩm',
                    data: @json($productCounts),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5 // mỗi bước chia 5 đơn vị
                    },
                    grid: {
                        drawBorder: false,
                        color: '#f0f0f0' // nhẹ nhàng cho lưới
                    }
                }
            }
        }
    });
</script>
@else
<script>
    const ctx = document.getElementById('summaryChart2').getContext('2d');

    const summaryChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
            datasets: [
                {
                    label: 'Khách Hàng',
                    data: @json($userCounts),
                    borderColor: 'rgba(0, 123, 255, 1)',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Đơn Hàng',
                    data: @json($orderCounts),
                    borderColor: 'rgba(40, 167, 69, 1)',
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    pointBackgroundColor: 'rgba(40, 167, 69, 1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Đánh Giá',
                    data: @json($reviewCounts),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5 // mỗi bước chia 5 đơn vị
                    },
                    grid: {
                        drawBorder: false,
                        color: '#f0f0f0' // nhẹ nhàng cho lưới
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx3 = document.getElementById('summaryChart3').getContext('2d');

    const summaryChart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: [
                'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
            datasets: [
                {
                    label: 'Doanh Thu',
                    data: @json($revenueCounts),
                    borderColor: 'rgba(0, 123, 255, 1)',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false,
                        color: '#f0f0f0' // nhẹ nhàng cho lưới
                    }
                }
            }
        }
    });
</script>
@endif
@endsection