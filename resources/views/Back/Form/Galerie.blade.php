<?php
if($galerie->id){
    $options=['method'=>'put','url'=>action('Back\Actions\GalerieController@update',$galerie)];
}else{
    $options=['method'=>'post','url'=>action('Back\Actions\GalerieController@store')];
}
?>
<div class="card col s5">
    <div class="card-content">
        <span class="card-title">{{$galerie->id?'Modifier':'Enregistrer'}} Galerie</span>
        {!! Form::model($galerie,$options)!!}
        <div class="form-group">
            {!! Form::label('Titre:') !!}
            {!! Form::text('titre',null) !!}<br/>
        </div>
        <button class="btn waves-effect waves-light green">{{$galerie->id?'Modifier':'Enregistrer'}}</button>
        {!! Form::close() !!}
    </div>
</div>