@extends('layout.main')

@section('title', 'Contacts')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-6">
                    <h1 class="h3 mb-3">Contacts</h1>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('user.contact.create') }}" class="btn btn-outline-primary">Add Contact</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Email</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ali</td>
                                        <td>4535456</td>
                                        <td>ali@gmail.com</td>
                                        <td>Friends</td>
                                        <td>
                                            <a href="" class="btn btn-primary">Show</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="alert alert-info m-0">No record found!</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
