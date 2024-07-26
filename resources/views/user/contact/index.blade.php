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
                            @if (count($contacts) > 0)
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
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $contact->first_name . ' ' . $contact->last_name }}</td>
                                                <td>{{ $contact->mobile }}</td>
                                                <td>{{ $contact->email ?? 'N/A' }}</td>
                                                <td>{{ $contact->category->name }}</td>
                                                <td>
                                                    <a href="{{ route('user.contact.show', $contact) }}"
                                                        class="btn btn-primary">Show</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info m-0">No record found!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
