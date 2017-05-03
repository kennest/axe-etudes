<?php
if($web->id){
    $options=['method'=>'put','url'=>action('Back\Actions\ProfilController@UpdateinfoSup',$web)];
}else{
    $options=['method'=>'post','url'=>action('Back\Actions\ProfilController@StoreInfoSup')];
}
?>

<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos références Web</span>
        {!! Form::model($web,$options)!!}
        <div class="form-group">
            <label>Geolocalisation:</label>
                <div id="gmap" style="margin:auto; height:400px; border:1px solid #cecece;" title="Bougez le marqueur pour choisir votre position."></div>
            <input type="hidden" name="lat" id="lat"/>
            <input type="hidden" name="long" id="lng"/>
        </div>
        <div class="form-group">
            {!! Form::url('facebook',null,['placeholder'=>'Facebook...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::url('twitter',null,['placeholder'=>'Twitter...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::url('youtube',null,['placeholder'=>'Youtube...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::url('siteweb',null,['placeholder'=>'Site Web...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::text('rue',null,['placeholder'=>'Rue...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::text('bp',null,['placeholder'=>'Boite Postale...']) !!}<br/>
        </div>
        <div class="form-group">
            {!! Form::text('quartier',null,['placeholder'=>'Quartier...']) !!}<br/>
        </div>
        <button class="btn waves-effect waves-light green">{{$web->id?'Modifier':'Enregistrer'}}
            <i class="material-icons right">add</i>
        </button>
        {!! Form::close() !!}
    </div>
</div>