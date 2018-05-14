@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{ $company->name }} company<span class="float-right">
                 <a href="{{ route('company.edit', ['company' => $company ]) }}" class="btn btn-info">Edit</a>
                        <form class="float-right" method="post" action="{{ route('company.destroy', ['company' => $company ]) }}">
                            <input type="hidden" name="_method" value="delete">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
            </span></h1>
        <table class="table table-responsive">
            <tr>
                <th>
                    ID
                </th>
                <td>
                    {{ $company->id }}
                </td>
            </tr>
            <tr>
                <th>
                    Website
                </th>
                <td>
                    <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                </td>
            </tr>
            <tr>
                <th>
                    Email
                </th>
                <td>
                    <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                </td>
            </tr>
            <tr>
                <th>
                    Logo
                </th>
                <td>
                    <img src="{{ \Storage::url('public/' . $company->logo) }}" alt="Logo" class="img img-responsive" />
                </td>
            </tr>
        </table>


    <h3>Employees in this company</h3>
    <table border="0" class="table-responsive table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>
                ID
            </th>
            <th>
                First Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                E-Mail
            </th>
            <th>
                Phone
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse ($employees as $employe)
        <tr>
            <td><a href="{{ route('employe.show', $employe->id) }}">{{ $employe->id }}</a></td>
            <td>{{ $employe->first_name }}</td>
            <td>{{ $employe->last_name }}</td>
            <td><a href="mailto:{{ $employe->email }}">{{ $employe->email }}</a></td>
            <td><a href="tel:{{ $employe->phone }}">{{ $employe->phone }}</a></td>
        </tr>
        @empty
        <tr>
            <th colspan="6">Empty</th>
        </tr>
        @endforelse
        </tbody>
        <tfoot>
        <tr>
            <th colspan="6"> {{ $employees->links() }}</th>
        </tr>
        </tfoot>
    </table>

</div>
@endsection