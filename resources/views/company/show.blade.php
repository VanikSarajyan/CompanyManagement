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
                            <button class="btn btn-danger">Delete</button>
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
        <button class="btn btn-success">Add Employee</button>
    </div>
</div>
@endsection