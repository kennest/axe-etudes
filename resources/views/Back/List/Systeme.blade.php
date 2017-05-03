@extends('Back.back')
@section('content')
<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos Sytemes</span>
        <table class="responsive-table striped">
            <thead>
            <tr>
                <th>Titre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($systemes as $systeme)
                <tr>
                    <td class="text-center">{{$systeme->titre}}</td>
                    <td>
                        <form action="{{ URL::route('systeme.destroy',$systeme) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn waves-effect waves-light red">Supprimer
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
    @endsection