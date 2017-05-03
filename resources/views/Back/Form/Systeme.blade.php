<?php
    $options=['method'=>'post','url'=>action('Back\Actions\SystemeController@store')];
?>
<div class="card col s5">
    <div class="card-content">
        <span class="card-title">Choisir Systeme</span>
        {!! Form::open($options)!!}
        <div class="form-group">
            {!! Form::label('Systemes:') !!}
            {!! Form::select('systemes[]',$systemes->pluck('titre','id'),$systemes->pluck('id'),['multiple'=>true]) !!}
        </div>
        <button class="btn waves-effect waves-light green">Choisir</button>
        {!! Form::close() !!}
    </div>
</div>