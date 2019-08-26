@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex">
        <img src="/storage/logos/{{ $company->logo }}" class="mt-3" width="250px" height="70px" alt="logo">
        <div class="d-flex flex-column ml-5">
            <h1>{{ $company->name }}</h1>
            <small>{{ $company->email }}</small>
            <a href="http://{{ $company->website }}">{{ $company->website }}</a>
        </div>
    </div>
    <br>
    <div class="row d-flex flex-column">
        <h1>Employees</h1><br>
        @if ($company->employees->count() > 0)
        <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <button class="btn btn-primary">Update</button>
                            <button 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteEmployeeModal"
                                data-id={{ $employee->id }}
                                data-name="{{ $employee->first_name . " " . $employee->last_name }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <div class="row d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
        @else 
        <h4>There are no employees in this company.</h4>
        @endif
    </div>
    <div class="row d-flex flex-row-reverse">
            <button class="btn btn-success" data-toggle="modal" data-target="#createEmployeeModal">Add Employee</button>
    </div>

    <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/employees" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="website">Phone Number</label>
                            <input type="text" class="form-control" name="phone" required>
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

    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="employeeDeleteText">Are you sure you want to delete this employee?</p>
                    <form id="employeeDeleteForm" action="/employees/id" enctype="multipart/form-data" method="POST">
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
        $('#deleteEmployeeModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            $('#employeeDeleteText').text("Are you sure you want to delete " + name + "?")
            $('#employeeDeleteForm').attr("action", "{{ url('/employees') }}" + "/" + id);
        });

        // $('#updateCompanyModal').on('show.bs.modal', function (event) {
        //     let button = $(event.relatedTarget);
        //     $('#companyName').val(button.data('name'));
        //     $('#companyEmail').val(button.data('email'));
        //     $('#companyWebsite').val(button.data('website'));
        //     $('#companyUpdateForm').attr("action", "{{ url('/companies') }}" + "/" + button.data('id'));
        // });
    })
</script>
@endsection