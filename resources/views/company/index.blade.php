@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td><a href="/companies/{{ $company->id }}"><img src="/storage/logos/{{$company->logo }}" width="200px" height="50px" /></a></td>
                    <td><a href="/companies/{{ $company->id }}" class="text-dark"><strong>{{ $company->name }}</strong></a></td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#updateModal">Uptade</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <div class="row d-flex justify-content-center">
        {{ $companies->links() }}
    </div>

    <div class="row d-flex flex-row-reverse">
        <button class="btn btn-success" data-toggle="modal" data-target="#createModal">Create Company</button>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/companies" enctype="multipart/form-data" method="POST">
                        @csrf 

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" required>
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" name="logo" required>
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button type="button" class="btn btn-default mx-1" data-dismiss="modal">Close</button>
                            <input type="submit" value="Create" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/companies/id" enctype="multipart/form-data" method="POST">
                        @csrf 

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" required>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" name="logo" required>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button type="button" class="btn btn-default mx-1" data-dismiss="modal">Close</button>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this company?</p>
                    <form action="/companies/id" enctype="multipart/form-data" method="POST">
                        @csrf 
                        <div class="d-flex flex-row-reverse">
                            <button type="button" class="btn btn-default mx-1" data-dismiss="modal">Close</button>
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
</div>
@endsection
