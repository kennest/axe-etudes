@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('success.register')
    @include('Back.List.Videos')
@endsection