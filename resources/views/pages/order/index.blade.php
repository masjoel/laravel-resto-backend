@extends('layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>
                {{-- <div class="section-header-button">
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">All order</div>
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

                                <div class="float-right">
                                    <form method="GET" action="{{ route('order.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th class="text-right">Produk</th>
                                            <th class="text-right">Sub Total</th>
                                            <th>Diskon</th>
                                            <th class="text-right">Tax (11%)</th>
                                            <th class="text-right">Total</th>
                                            <th>Metode Bayar</th>
                                            <th class="text-right">Nominal Bayar</th>
                                            <th>Created At</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        @foreach ($orders as $index => $order)
                                            <tr>

                                                <td class="text-right"><a href="{{ route('order.show', $order->id) }}">{{ $order->total_item }} item</a></td>
                                                <td class="text-right">{{ number_format($order->sub_total) }}</td>
                                                <td>{{ $order->discount>0 ? number_format($order->discount).'%' : '' }}</td>
                                                <td class="text-right">{{ number_format($order->tax) }}</td>
                                                <td class="text-right">Rp.{{ number_format($order->total) }}</td>
                                                <td>{{ $order->payment_method }}</td>
                                                <td class="text-right">Rp.{{ number_format($order->payment_amount) }}</td>
                                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                                {{-- <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('order.edit', $order->id) }}'
                                                            class="btn btn-sm btn-info btn-icon mr-1">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <a href="#" type="button"
                                                            class="btn btn-sm btn-danger btn-icon confirm-delete"
                                                            id="delete-data" data-id="{{ $order->id }}">
                                                            <i class="fas fa-times"></i> Delete
                                                        </a>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $orders->withQueryString()->links() }}
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
