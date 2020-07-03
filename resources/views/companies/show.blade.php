@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div>
                <h1>{{ $company->name }}</h1>
            </div>
            <div class="card">
                <img class="card-img-top" src="/storage/logos/{{ $company->logo }}" alt="logo">
                <div class="card-body">
                    <h5 class="card-title">{{ $company->name }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ __('messages.email') }} - {{ $company->email }}</li>
                    <li class="list-group-item">{{ __('messages.website') }} - {{ $company->website }}</li>
                </ul>
                <div class="card-body">
                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mb-3">{{ __('messages.delete') }}</button>
                    </form>
                    <form action="{{ route('companies.edit', $company->id) }}" method="GET">
                        <button class="btn btn-primary mb-3">{{ __('messages.edit') }}</button>
                    </form>
                </div>
            </div>
            <div class="mt-3">
            </div>
        </div>
        <div class="col-md-9">
            @if(!$company->employees->isEmpty())
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->employees as $employee)
                    <tr>
                        <td>
                            <a href="/employees/{{ $employee->id }}">
                                {{ $employee->first_name }}
                            </a>
                        </td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <a href="/companies"><button class="btn btn-primary w-100">{{ __('messages.backToAllCompanies') }}</button> </a>
        </div>
        <div class="col-md-9">
            <div>
                {{ $company->employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection