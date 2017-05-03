<?php
if($dossier->id){
    $options=['method'=>'put','url'=>action('Back\Actions\DossierController@update',$dossier)];
}else{
    $options=['method'=>'post','url'=>action('Back\Actions\DossierController@store')];
}
?>

<div class="card col s5">
    <div class="card-content">
        <span class="card-title">{{$dossier->id?'Modifier':'Enregistrer'}} Dossier d'Inscription</span>
    {!! Form::model($dossier,$options)!!}
    <div class="input-field">
        <p>
            <input name="types" type="radio" id="new" value="new"/>
            <label for="new">Nouvelle Inscription</label>
        </p>
        <p>
            <input name="types" type="radio" id="old" value="old"/>
            <label for="old">Réinscription</label>
        </p>
        <p>
            <input class="with-gap" name="types" type="radio" id="candidat" value="candidat"/>
            <label for="candidat">Dossier de candidature</label>
        </p>
    </div>
    <div class="input-field">
        {!! Form::text('libelle',null,[]) !!}
        {!! Form::label('Libelle:') !!}
    </div>
    <div class="input-field">
        {!! Form::number('frais',null,[]) !!}
        {!! Form::label('Frais:') !!}
    </div>
    <button class="btn waves-effect waves-light green">{{$dossier->id?'Modifier':'Enregistrer'}}</button>
    {!! Form::close() !!}
</div>
</div>