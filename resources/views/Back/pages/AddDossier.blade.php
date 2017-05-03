@extends('Back.back')

@section('content')
    @include('errors.validation')
    @include('success.register')
    @include('Back.Form.Dossier')
    @include('Back.List.Dossier')
@endsection