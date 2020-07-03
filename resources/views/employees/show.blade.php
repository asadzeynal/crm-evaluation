@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        <h1>{{ $employee->first_name }} {{ $employee->last_name }}</h1>
    </div>
    <div class="card" align style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $employee->first_name }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{ __('messages.email') }} - {{ $employee->email }}</li>
            <li class="list-group-item">{{ __('messages.phoneNumber') }} - {{ $employee->phone_number }}</li>
            <li class="list-group-item">{{ __('messages.companyParent') }} - {{ $employee->company->name }}</li>
        </ul>
        <div class="card-body">
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mb-3">{{ __('messages.delete') }}</button>
            </form>
            <form action="{{ route('employees.edit', $employee->id) }}" method="GET">
                <button class="btn btn-primary mb-3">{{ __('messages.edit') }}</button>
            </form>
        </div>
    </div>
    <a href="/employees" class=""><- {{ __('messages.backToAllEmployees') }} </a>
</div> 
@endsection