@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('success.register')
    @include('Back.Form.Photo')
    @include('Back.List.Photo')
@endsection