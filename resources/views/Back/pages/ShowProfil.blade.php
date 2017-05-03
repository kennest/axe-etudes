@extends('Back.back')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img height="450" src="{{Storage::url(Auth::guard('etablissements')->user()->logo)}}"/>
                </div>
                <div class="card-title">
                    <h3><strong><i class="small material-icons">person_pin</i>{{$etablissement->sigle}}</strong></h3>
                    <blockquote>{{$etablissement->telephone}}</blockquote>
                    <blockquote>{{$etablissement->email}}</blockquote>
                    <blockquote>{{$etablissement->type()->first()->titre}}</blockquote>
                </div>
                <div class="card-content">
                    <h4><em>Présentation</em></h4>
                    <hr/>
                    <p>{{$etablissement->presentation}}</p>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a href="#web">Sur le Web</a></li>
                        <li class="tab"><a class="active" href="#physik">Localisation physique</a></li>
                    </ul>
                </div>
                <div class="card-content grey lighten-4">
                    <div id="web">
                        <h5>Vos Informations sur la toile</h5>
                        <div id="gmap"></div>
                        @if(!empty($etablissement->web()->first()))
                            <ul class="collection">
                                <li class="collection-item avatar">
                                    <i class="fa fa-facebook medium"></i>
                                    <span class="title">{{$etablissement->web->first()->facebook}}</span>
                                    <p><a href="{{$etablissement->web()->first()->facebook}}">Accèder
                                            <i class="fa fa-send"></i></a></p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="fa fa-twitter medium"></i>
                                    <span class="title">{{$etablissement->web()->first()->twitter}}</span>
                                    <p><a href="{{$etablissement->web()->first()->twitter}}">Accèder<i
                                                    class="fa fa-send"></i></a></p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="fa fa-youtube medium"></i>
                                    <span class="title">{{$etablissement->web()->first()->youtube}}</span>
                                    <p><a href="{{$etablissement->web()->first()->youtube}}">Accèder<i class="fa fa-send"></i></a></p>
                                </li>
                                <li class="collection-item avatar">
                                    <i class="fa fa-globe medium"></i>
                                    <span class="title">{{$etablissement->web()->first()->siteweb}}</span>
                                    <p><a href="{{$etablissement->web()->first()->siteweb}}">Accèder<i
                                                    class="fa fa-send"></i></a></p>
                                </li>
                            </ul>
                        @else
                            <p>
                            <h3><i class="fa fa-warning medium"></i>AUCUNE INFORMATIONS</h3>
                            <a href="{{route('profil.createInfoSup')}}">AJOUTER LES INFOS MANQUANTES...</a>
                            </p>
                        @endif

                    </div>
                    <div id="physik">
                        <h5>Vos Informations dans la vie réelle</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
