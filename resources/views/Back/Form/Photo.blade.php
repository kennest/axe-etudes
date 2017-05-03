<?php
if ($photo->id) {
    $options = ['method' => 'put', 'url' => action('Back\Actions\GalerieController@updatePhoto', $photo), 'files' => true];
} else {
    $options = ['method' => 'post', 'url' => action('Back\Actions\GalerieController@storePhoto'), 'files' => true];
}
?>


<div class="card col s5">
    <div class="card-content">
        <span class="card-title">{{$photo->id?'Modifier la photo':'Enregistrer les photos'}}</span>
        {!! Form::open($options)!!}
        @if($galeries->first())
            @if($photo->id)
                <p>&nbsp;</p>
            @else
                <div class="input-field col s12">
                    {!! Form::select('galerie',$list_galeries->pluck('titre','id'),null,[]) !!}
                    <label>Galerie:</label>
                </div>
                <p>&nbsp;</p>
            @endif
        @else
            <a href="{{route('galerie.create')}}" class="btn waves-effect waves-light blue">Ajouter d'abord une galerie
                ...</a>
        @endif
        @if($photo->id)
            <p>
                <strong>
                    <h4>
                        {{$photo->galerie()->first()->titre}}
                    </h4>
                </strong>
            </p>
            <img height="100" width="80" src="{{Storage::url($photo->path)}}">
            <div class="file-field input-field">
                <div class="btn waves-effect waves-light orange">
                    <span>Choisir la photo</span>
                    <input type="file" accept="image/*" name="path">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                <span class="card yellow"><em>Taille Max:<strong>1024ko soit 1Mo</strong></em></span>
            </div>
        @else
            <div class="file-field input-field">
                <div class="btn waves-effect waves-light orange">
                    <span>Choisir les photos</span>
                    <input type="file" name="path[]" accept="image/*" multiple>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                <span class="card yellow"><em>Taille Max:<strong>1024ko soit 1Mo</strong></em></span>
            </div>

        @endif
        <button class="btn waves-effect waves-light green">{{$photo->id?'Modifier':'Enregistrer'}}</button>

        {!! Form::close() !!}
    </div>
</div>