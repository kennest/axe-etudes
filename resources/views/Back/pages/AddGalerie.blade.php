@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('Back.Form.Galerie')
    @include('Back.List.Galerie')
@endsection