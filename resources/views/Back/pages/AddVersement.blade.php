@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('success.register')
    @include('Back.Form.Versement')
    @include('Back.List.Versement')
@endsection