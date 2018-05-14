@extends('layouts.app')

@section('content')
<div class="container">
    @if (!empty($company) && $company->id)
        <h1>Edit company</h1>
        <form action="{{ route('company.update', compact('company')) }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put">
    @else
        <h1>Add company</h1>
        <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
    @endif
            @include('partials.alert')

            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{ isset($company) ? $company->name : '' }}" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" value="{{ isset($company) ? $company->website : '' }}" class="form-control" id="website" name="website">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ isset($company) ? $company->email: '' }}" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                @if (!empty($company) && $company->logo)
                    <img src="{{ \Storage::url('public/' . $company->logo) }}" alt="Logo" />
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-outline-primary">
                    Save
                </button>
            </div>
        </form>
</div>
@endsection