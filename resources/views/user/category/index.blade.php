@extends('layout.main')

@section('title', 'Categories')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-6">
                    <h1 class="h3 mb-3">Categories</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" onclick="clearAddModal()"
                        data-bs-target="#addModal">
                        Add Category
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="alert"></div>
                            <div id="response">
                                {{-- <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Contacts</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Friends</td>
                                            <td>645</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="editCategory(1)"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" onclick="deleteCategory(1)"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> --}}

                                {{-- <div class="alert alert-info m-0">No record found</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @include('partials.modals')
    <script>
        const ID = @json(Auth::id());
        const showAllRoute = @json(route('api.user.categories', Auth::id()));
        const addRoute = @json(route('api.user.category.create'));
        const showSingleRoute = @json(route('api.user.category.show', ':id'));
        const updateRoute = @json(route('api.user.category.update', ':id'));
        const destroyRoute = @json(route('api.user.category.destroy', ':id'));
    </script>
    <script src="{{ asset('template/js/custom.js') }}"></script>
@endsection
