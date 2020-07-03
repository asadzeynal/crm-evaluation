@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('messages.companies') }}</h1>
    <div class="row">
        @foreach($companies as $company)
        <div class="col-md-4">
            <a href="/companies/{{ $company->id }}">
                <div class="card" style="width: 18rem;">
                    @if(env('FILESYSTEM_DRIVER') === 's3')
                    <!-- Hardcoded for demonstration purposes -->
                    <img class="card-img-top" style="width: 100%; height: 15vw; object-fit: contain;" src="http://crmeval.s3.eu-central-1.amazonaws.com/public/logos/{{ $company->logo }}" alt="logo">
                    @elseif(env('FILESYSTEM_DRIVER') === 'local')
                    <img class="card-img-top" style="width: 100%; height: 15vw; object-fit: contain;" src="/storage/logos/{{ $company->logo }}" alt="logo">
                    @endif
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