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
                    <td><a href="/companies/{{ $company->id }}"><img src="/storage/logos/{{$company->logo }}" width="180px" height="50px" /></a></td>
                    <td><a href="/companies/{{ $company->id }}" class="text-dark"><strong>{{ $company->name }}</strong></a></td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        <button 
                            class="btn btn-primary mr-2" 
                            data-toggle="modal" 
                            data-target="#updateCompanyModal"
                            data-id={{ $company->id }}
                            data-name="{{ $company->name }}"
                            data-email="{{ $company->email }}"
                            data-website="{{ $company->website }}">
                            Uptade
                        </button>
                        <button 
                            class="btn btn-danger" 
                            data-toggle="modal" 
                            data-target="#deleteCompanyModal"
                            data-id={{ $company->id }}
                            data-name="{{ $company->name }}">
                            Delete
                        </button>
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
        <button class="btn btn-success" data-toggle="modal" data-target="#createCompanyModal">Create Company</button>
    </div>

    <div class="modal fade" id="createCompanyModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
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
                            <input type="file" class="form-control-file" name="logo">
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


    <div class="modal fade" id="updateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="companyUpdateForm" action="/companies/id" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="companyName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="companyEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" name="website" id="companyWebsite" required>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" name="logo">
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

    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="companyDeleteText">Are you sure you want to delete this company?</p>
                <form id="companyDeleteForm" action="/companies/id" enctype="multipart/form-data" method="POST">
                    @csrf 
                    @method('DELETE')
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
<script type="text/javascript">
    $( document ).ready(function() {
        $('#deleteCompanyModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            $('#companyDeleteText').text("Are you sure you want to delete " + name + "?")
            $('#companyDeleteForm').attr("action", "{{ url('/companies') }}" + "/" + id);
        });

        $('#updateCompanyModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            $('#companyName').val(button.data('name'));
            $('#companyEmail').val(button.data('email'));
            $('#companyWebsite').val(button.data('website'));
            $('#companyUpdateForm').attr("action", "{{ url('/companies') }}" + "/" + button.data('id'));
        });
    })
    </script>
@endsection
