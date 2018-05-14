@extends('layouts.app')

@section('content')
<div class="container">
    @if (!empty($employe) && $employe->id)
        <h1>Edit employe</h1>
        <form action="{{ route('employe.update', compact('employe')) }}" method="post">
            <input type="hidden" name="_method" value="put">
    @else
        <h1>Add employe</h1>
        <form action="{{ route('employe.store') }}" method="post">
    @endif
            @include('partials.alert')

            @csrf
            <div class="form-group">
                <label for="first_name">First name</label>
                <input type="text" value="{{ isset($employe) ? $employe->first_name : '' }}" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last name</label>
                <input type="text" value="{{ isset($employe) ? $employe->last_name : '' }}" class="form-control" id="last_name" name="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" value="{{ isset($employe) ? $employe->email: '' }}" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" value="{{ isset($employe) ? $employe->phone: '' }}" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <select name="company_id" id="company" class="form-control">
                    @foreach (\App\Company::get(['id','name']) as $company)
                        <option value="{{$company->id}}" @if( isset($employe)  && ($company->id == $employe->company_id)) selected @endif >{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-outline-primary">
                    Save
                </button>
            </div>
        </form>
</div>
@endsection