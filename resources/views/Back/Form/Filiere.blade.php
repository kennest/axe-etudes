<?php
if($filiere->id){
    $options=['method'=>'put','url'=>action('Back\Actions\FiliereController@update',$filiere)];
}else{
    $options=['method'=>'post','url'=>action('Back\Actions\FiliereController@store')];
}
?>
<div class="card col s5">
    <div class="card-content">
        <span class="card-title">Choisir vos filières</span>
    {!! Form::open($options)!!}
    <div class="form-group">
        {!! Form::select('filieres[]',$filieres->pluck('titre','id'),$filieres->pluck('id'),['multiple'=>true]) !!}<br/>
        {!! Form::label('Filieres:') !!}
    </div>
    <button class="btn waves-effect waves-light green">Enregistrer</button>
    {!! Form::close() !!}
</div>
</div>