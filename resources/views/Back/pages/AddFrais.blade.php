@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('Back.Form.Frais')
    @include('Back.List.Frais')
@endsection