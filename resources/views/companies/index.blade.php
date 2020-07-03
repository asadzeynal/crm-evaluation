@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('messages.companies') }}</h1>
    <div class="row">
        @foreach($companies as $company)
        <div class="col-md-4">
            <a href="/companies/{{ $company->id }}">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="/storage/logos/{{ $company->logo }}" alt="company logo">
                    <div class="card-body">
                        <p class="card-text"><a href="/companies/{{ $company->id }}">{{ $company -> name }}</a></p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $companies->links() }}
    </div>

</div>

@endsection