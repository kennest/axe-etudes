@extends('Back.back')

@section('content')
    @include('errors.validation')
   @include('Back.Form.Filiere')
    @include('Back.List.Filieres')
@endsection