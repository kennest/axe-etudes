<html>
<head>
    <title>{{Auth::guard('etablissements')->user()->sigle}} | Tableau de Bord</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {!! Html::style('Back/materialize/css/materialize.css') !!}
    {!! Html::style('Back/font-awesome/css/font-awesome.css') !!}
    {!! Html::style('Back/style/style.css') !!}
    {!! Html::script('Back/jquery/dist/jquery.js') !!}
    {!! Html::script('Back/materialize/js/materialize.js') !!}
    <script>
        $(document).ready(function () {
            $('select').material_select();
            $('.chips').material_chip();
        });
    </script>
    <style>
        fieldset {
            border: 2px solid #1f897f;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }

        legend {
            font-family: "Roboto", sans-serif;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="nav-extended navbar-fixed cyan darken-4">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">
                    <img height="50" width="50" src="{{Storage::url(Auth::guard('etablissements')->user()->logo)}}"/>
                    {{Auth::guard('etablissements')->user()->sigle}}
                </a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="">Sass</a></li>
                    <li><a href="">Components</a></li>
                    <li><a href="{{route('dash_logout')}}">Se Deconnecter</a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="">Sass</a></li>
                    <li><a href="">Components</a></li>
                    <li><a href="{{route('dash_logout')}}">Se Deconnecter</a></li>
                </ul>
            </div>
            {{--<div class="nav-content">--}}
            {{--<ul class="tabs tabs-transparent">--}}
            {{--<li class="tab"><a href="#test1">Test 1</a></li>--}}
            {{--<li class="tab"><a class="active" href="#test2">Test 2</a></li>--}}
            {{--<li class="tab disabled"><a href="#test3">Disabled Tab</a></li>--}}
            {{--<li class="tab"><a href="#test4">Test 4</a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
        </nav>
    </div>
</div>
<p>&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="card blue-grey darken-1 col s3">
        <div class="card-content white-text">
                    <span class="card-title">Menu</span>
                    <ul id="profil" class="dropdown-content">
                        <li><a href="{{route('profil.show')}}">Voir</a></li>
                        <li><a href="">Modifier</a></li>
                        <li><a href="{{route('profil.createInfoSup')}}">Infos Sup...</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="profil">PROFIL<i
                                class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="ecolage" class="dropdown-content">
                        <li><a href="{{route('systeme.create')}}">Choisir votre Système(LMD/INGENIEUR)</a></li>
                        <li><a href="{{route('filiere.create')}}">Filières</a></li>
                        <li><a href="{{route('frais.create')}}">Niveaux - Frais</a></li>
                        <li><a href="{{route('dossier.create')}}">Dossiers d'inscription</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="ecolage">FILIERES - FRAIS
                        D'ECOLAGES<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="galerie" class="dropdown-content">
                        <li><a href="{{route('galerie.create')}}">Galeries</a></li>
                        <li><a href="{{route('galerie.createPhoto')}}">Photos</a></li>
                        <li><a href="{{route('galerie.listVideos')}}">Videos</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="galerie">GALERIE<i
                                class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="reduction" class="dropdown-content">
                        <li><a href="{{route('filiere.create')}}">Bon de Reduction</a></li>
                        <li><a href="{{route('frais.create')}}">Prise en charge</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="reduction">REDUCTION - PRISE EN
                        CHARGE<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="distinction" class="dropdown-content">
                        <li><a href="{{route('filiere.create')}}">Distinctions</a></li>
                        <li><a href="{{route('frais.create')}}">Actualités</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="distinction">DISTINCTIONS -
                        ACTUALITES<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="geolocalisation" class="dropdown-content">
                        <li><a href="{{route('frais.create')}}">Call me back</a></li>
                        <li><a href="{{route('frais.create')}}">Partenaires</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="geolocalisation">PARTENAIRES - CALL ME BACK<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <ul id="evenement" class="dropdown-content">
                        <li><a href="{{route('filiere.create')}}">Préinscriptions</a></li>
                        <li><a href="{{route('frais.create')}}">Evènements</a></li>
                    </ul>
                    <a class="btn dropdown-button col s12" href="#!" data-activates="evenement">EVENMENTS - PREINSCRiP<i class="mdi-navigation-arrow-drop-down right"></i></a>
                </div>
        </div>
        <div class="col s9">
            @yield('content')
        </div>
    </div>
    @if($gmap=true)
        <!-- script de geolocalisation-->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT4AWhW03pKst47eVffsCrYw6DVQBu_tY" async="" defer="defer" type="text/javascript"></script>
                    <script>
                jQuery(function(){
                    /****** geolocalisation******/
                    var latlng = new google.maps.LatLng(5.336323,-4.027755);
                    var map = new google.maps.Map(document.getElementById('gmap'),{
                        zoom : 15,
                        center : latlng,
                        mapTypeId : google.maps.MapTypeId.ROADMAP
                    });
                    var marker = new google.maps.Marker({
                        position : latlng,
                        map : map,
                        title : 'Bougez ce marqueur!',
                        draggable : true
                    });

                    var geocoder = new google.maps.Geocoder();

                    google.maps.event.addListener(marker,'drag',function(){
                        setPosition(marker);
                    });

                    jQuery('#adresse_map').keypress(function(e){
                        if(e.keyCode==69){
                            var request = {
                                adress : $(this).val()
                            }
                            //geocoder.geocode({request,function(results,status)
                            geocoder.geocode( { 'adresse_map': address}, function(results, status){
                                if(status == google.maps.GeocoderStatus.OK){
                                    pos = results[0].geometry.location;
                                    map.setCenter(pos);
                                    marker.setPosition(pos);
                                    setPosition(marker);
                                }
                            });
                            return false;
                        }

                    });

                    function setPosition(marker){
                        var pos = marker.getPosition();
                        jQuery('#lat').val(pos.lat());
                        jQuery('#lng').val(pos.lng());
                    }
                });
            </script>
        @endif
</div>
</body>
</html>