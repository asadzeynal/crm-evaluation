@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('messages.newEmployee') }}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/employees" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">{{ __('messages.firstName') }}:</label>
            <input type="text" class="form-control" placeholder="Joey" id="first_name" name="first_name">
        </div>
        <div class="form-group">
            <label for="last_name">{{ __('messages.lastName') }}:</label>
            <input type="text" class="form-control" placeholder="Tribbiani" id="last_name" name="last_name">
        </div>
        <div class="form-group">
            <label for="email">{{ __('messages.email') }}:</label>
            <input type="text" class="form-control" placeholder="admin@trvl.com" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="phone_number">{{ __('messages.phoneNumber') }}:</label>
            <input type="text" class="form-control" placeholder="+994501111111" id="phone_number" name="phone_number">
        </div>
        <div class="form-group">
            {{ Form::label('company_id',  __('messages.companyParent').':') }}
            {{ Form::select('company_id', $companies, ['class' => 'form-control']) }}
        </div>
        <input type="submit" class="btn btn-primary" value="{{ __('messages.newEmployee') }}">
    </form>
</div>
@endsection