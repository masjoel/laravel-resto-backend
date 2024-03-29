@extends('layouts.app')

@section('title', 'Order Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Order Detail</h1>
                {{-- <div class="section-header-button">
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">Order detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                        @foreach ($orders as $index => $order)
                                            <tr>
                                                <td>{{ $order->product->name }}</td>
                                                <td class="text-right">{{ number_format($order->price) }}</td>
                                                <td class="text-right">{{ $order->quantity }}</td>
                                                <td class="text-right">Rp.{{ number_format($order->price * $order->quantity) }}
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script>
        $(document).on("click", "a#delete-data", function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            showDeletePopup(BASE_URL + '/order/' + id, '{{ csrf_token() }}', '', '',
                BASE_URL + '/order');
        });
    </script>
@endpush
