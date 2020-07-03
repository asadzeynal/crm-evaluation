@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('messages.newCompany') }}</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/companies" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('messages.name') }}:</label>
            <input type="text" class="form-control" placeholder="TRVL" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="email">{{ __('messages.email') }}:</label>
            <input type="text" class="form-control" placeholder="trvl@trvl.com" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="website">{{ __('messages.website') }}:</label>
            <div class="input-group">
                    <div class="input-group-prepend">
                        <select name="protocol" id="protocol">
                            <option value="https://">https://</option>
                            <option value="http://">http://</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="trvl.com" id="website" name="website">
            </div>
        </div>
        <div class="form-group">
            <label for="website">{{ __('messages.logo') }}:</label>
            <br>
            <input type="file" class="" name="logo" id="logo" accept="image/png, image/jpeg">
        </div>
        <input type="submit" class="btn btn-primary" value="{{ __('messages.add') }} {{ __('messages.company') }}">
    </form>
</div>
@endsection