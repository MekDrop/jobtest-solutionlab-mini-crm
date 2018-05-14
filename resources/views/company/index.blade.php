@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies     <a href="{{ route('company.create') }}" class="btn btn-primary float-right">Add</a>
    </h1>
    @include('partials.alert')
    <table border="0" class="table-responsive table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Website
                </th>
                <th>
                    E-Mail
                </th>
                <th>
                    Logo
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td><a href="{{ route('company.show', $company->id) }}">{{ $company->id }}</a></td>
                    <td>{{ $company->name }}</td>
                    <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                    <td><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></td>
                    <td><img src="{{ \Storage::url('public/small_' . $company->logo) }}" alt="Logo" class="img img-responsive img-thumbnail" /></td>
                    <td>
                        <a href="{{ route('company.edit', ['company' => $company ]) }}" class="btn btn-info">Edit</a>
                        <form  class="float-right" method="post" action="{{ route('company.destroy', ['company' => $company ]) }}">
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
                    <th colspan="6">Empty</th>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
        <tr>
            <th colspan="6"> {{ $companies->links() }}</th>
        </tr>
        </tfoot>
    </table>

</div>
@endsection