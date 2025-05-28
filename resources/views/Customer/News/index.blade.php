@extends('Customer.layouts.app')
@section('title', 'Tin Tức')
@section('content')
    <div class="page-header breadcrumb-wrap" style="border-bottom: unset;">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('customer.home.index') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
                <span></span> Tin Tức
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loop-grid">
                        <div class="row">
                            @foreach ($news as $item)
                                <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
                                    <div class="post-thumb">
                                        <a href="{{ route('customer.news.show', $item->id) }}">
                                            <img style="width: 100%; height: 311px;" class="border-radius-15" src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}" />
                                        </a>
                                    </div>
                                    <div class="entry-content-2">
                                        <h6 class="mb-10 font-sm">
                                            <a class="entry-meta text-muted" href="{{ route('customer.branches.show', $item->branch_id) }}">{{ $item->branch->name ?? 'N/A' }}</a>
                                        </h6>
                                        <h4 class="post-title mb-15 product-name">
                                            <a href="{{ route('customer.news.show', $item->id) }}">{{ $item->name }}</a>
                                        </h4>
                                        <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                            <div>
                                                <span class="entry-meta text-muted">{{ $item->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        {{ $news->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection