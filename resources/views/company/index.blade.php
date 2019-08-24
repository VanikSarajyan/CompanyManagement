@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>
    <table class="table">
        <thead>
            <th>Logo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
            <th colspan="2">Actions</th>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>{{$company->logo }}</td>
                    <td>{{$company->name }}</td>
                    <td>{{$company->email }}</td>
                    <td>{{$company->website }}</td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-success">Create Company</button>
</div>
@endsection
