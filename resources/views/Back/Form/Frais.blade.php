<?php
if($frais->id){
    $options=['method'=>'put','url'=>action('Back\Actions\FraisController@update',$frais)];
}else{
    $options=['method'=>'post','url'=>action('Back\Actions\FraisController@store')];
}
?>

<div class="card col s5">
    <div class="card-content">
        <span class="card-title">{{$frais->id?'Modifier':'Enregistrer'}}</span>
    {!! Form::model($frais,$options)!!}
    @if(empty($frais->id))
        <div class="input-field col s12">
        {!! Form::select('niveaux',$niveaux->pluck('titre','id'),null,[]) !!}
            <label>Niveaux:</label>
        </div>
    @else
        <div class="input-field col s12">
            <select name="niveaux">
                <option value="{{$niveau->id}}">{{$niveau->titre}}</option>
            </select>
            <label>Niveaux:</label>
        </div>
    @endif
    <div class="form-group">
        {!! Form::number('frais',null,['placeholder'=>'Frais d\'inscription...']) !!}<br/>
    </div>
    <div class="form-group">
        {!! Form::number('scolarite',null,['placeholder'=>'Scolarite...']) !!}<br/>
    </div>
    <button class="btn waves-effect waves-light green">{{$frais->id?'Modifier':'Enregistrer'}}
        <i class="material-icons right">add</i>
    </button>
    {!! Form::close() !!}
    </div>
</div>