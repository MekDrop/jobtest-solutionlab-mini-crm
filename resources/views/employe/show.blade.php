@extends('layouts.app')

@section('content')
<div class="container">
        <h1>{{ $employe->first_name }} {{ $employe->last_name }} employe
        <span class="float-right">
            <a href="{{ route('employe.edit', ['employe' => $employe ]) }}" class="btn btn-info">Edit</a>
                        <form  class="float-right" method="post" action="{{ route('employe.destroy', ['employe' => $employe ]) }}">
                            <input type="hidden" name="_method" value="delete">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
        </span>
        </h1>
        <table class="table table-responsive">
            <tr>
                <th>
                    ID
                </th>
                <td>
                    {{ $employe->id }}
                </td>
            </tr>
            <tr>
                <th>
                    Email
                </th>
                <td>
                    <a href="mailto:{{ $employe->email }}">{{ $employe->email }}</a>
                </td>
            </tr>
            <tr>
                <th>
                    Phone
                </th>
                <td>
                    <a href="tel:{{ $employe->phone }}">{{ $employe->phone }}</a>
                </td>
            </tr>
            <tr>
                <th>
                    Company
                </th>
                <td>
                    <a href="{{ route('company.show', $employe->company_id) }}">{{ $employe->company->name }}</a>
                </td>
            </tr>
        </table>
</div>
@endsection