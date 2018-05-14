@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees     <a href="{{ route('employe.create') }}" class="btn btn-primary float-right">Add</a>
    </h1>
    @include('partials.alert')
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
                <th>
                    Company
                </th>
                <th>

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
                    <td><a href="{{ route('company.show', $employe->company_id) }}">{{ $employe->company->name }}</a></td>
                    <td>
                        <a href="{{ route('employe.edit', ['employe' => $employe ]) }}" class="btn btn-info">Edit</a>
                        <form class="float-right" method="post" action="{{ route('employe.destroy', ['employe' => $employe ]) }}">
                            <input type="hidden" name="_method" value="delete">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="7">Empty</th>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
        <tr>
            <th colspan="7"> {{ $employees->links() }}</th>
        </tr>
        </tfoot>
    </table>

</div>
@endsection