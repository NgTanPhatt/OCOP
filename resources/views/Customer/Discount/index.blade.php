@extends('Customer.layouts.app')
@section('title', 'Mã Giảm Giá')

@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Mã Giảm Giá
            </div>
        </div>
    </div>

    <div class="page-content pt-20">
        <div class="container">
            <div class="row vendor-grid">
                @forelse ($discounts as $discount)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">{{ $discount->percent }}% GIẢM</span>
                                </div>
                                <div class="vendor-img d-flex align-items-center justify-content-center" style="height: 144px; background-color: #f3f3f3;">
                                    <h2 class="text-primary m-0">{{ $discount->code }}</h2>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="mb-20">
                                    <div class="product-category mb-5 text-muted">
                                        Áp dụng tại: <a href="{{ route('customer.branches.show', $discount->branch->id) }}"><strong>{{ $discount->branch->name ?? 'Tất cả chi nhánh' }}</strong></a>
                                    </div>
                                    <div class="product-rate-cover">
                                        <span class="text-muted">Hạn dùng: {{ \Carbon\Carbon::parse($discount->expiration_date)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-primary w-100 copy-btn" data-code="{{ $discount->code }}">
                                    Sao chép mã
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Hiện không có mã giảm giá nào.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.copy-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const code = this.dataset.code;
                navigator.clipboard.writeText(code).then(() => {
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: `Đã sao chép mã: ${code}`,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            });
        });
    </script>
@endsection