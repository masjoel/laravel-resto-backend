@extends('layouts.app')

@section('title', 'Categories')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Categories</h1>
                <div class="section-header-button">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('category.index') }}">Categories</a></div>
                    <div class="breadcrumb-item">All Category</div>
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
                                    <form method="GET" action="{{ route('category.index') }}">
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

                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($categories as $category)
                                            <tr>

                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    @if ($category->image)
                                                    <img src="{{ Storage::url('categories/'.$category->image) }}" alt=""
                                                            alt="" width="100px" class="img-thumbnail">
                                                    @else
                                                        <span class="badge badge-danger">No Image</span>
                                                    @endif
                                                </td>

                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('category.edit', $category->id) }}'
                                                            class="btn btn-sm btn-info btn-icon mr-1">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <a href="#" type="button"
                                                            class="btn btn-sm btn-danger btn-icon confirm-delete"
                                                            id="delete-data" data-id="{{ $category->id }}">
                                                            <i class="fas fa-times"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $categories->withQueryString()->links() }}
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
            showDeletePopup(BASE_URL + '/category/' + id, '{{ csrf_token() }}', '', '',
                BASE_URL + '/category');
        });
    </script>
@endpush
