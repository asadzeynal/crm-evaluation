@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('messages.employees') }}</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">{{ __('messages.firstName') }}</th>
                <th scope="col">{{ __('messages.lastName') }}</th>
                <th scope="col">{{ __('messages.email') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
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
        {{ $employees->links() }}
    </div>

</div>

@endsection