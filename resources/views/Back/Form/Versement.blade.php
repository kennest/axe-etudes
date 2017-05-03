<?php
if ($versement->id) {
    $options = ['method' => 'put', 'url' => action('Back\Actions\FraisController@updateVersement', $versement)];
} else {
    $options = ['method' => 'post', 'url' => action('Back\Actions\FraisController@storeVersement')];
}
?>

<div class="card blue darken-1 col s12">
    <div class="card-content white-text">
        <span class="card-title">Details du Niveau</span>
        <table class="responsive-table white-text">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Frais</th>
                <th>Scolarite</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">{{strtoupper($frais->niveau()->first()->titre)}}</td>
                    <td>{{$frais->frais}}</td>
                    <td>{{$frais->scolarite}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card col s5">
    <div class="card-content">
        <span class="card-title">{{$versement->id?'Modifier':'Enregistrer'}} Versement</span>
        <div class="card-panel teal">
          <span class="white-text">
              <strong><h5>Il  reste "{{$frais->scolarite-$total}}" à repartir.</h5></strong>
          </span>
        </div>
        </h6>
        {!! Form::model($versement,$options)!!}
        <div class="form-group">
            {!! Form::number('valeur',null,['placeholder'=>'Valeur du versement...']) !!}<br/>
                <input type="hidden" name="versement_id" value="{{$versement->id}}">
                <input type="hidden" name="frais_id" value="{{$frais->id}}">
        </div>
        <button class="btn waves-effect waves-light green">{{$versement->id?'Modifier':'Enregistrer'}}
            <i class="material-icons">add</i>
        </button>
        {!! Form::close() !!}
        @if(!$versement->id)
            <h1><strong>OU</strong></h1>
            <form method="post" action="">
                <h6 class="btn waves-effect cyan darken-4">diviser automatiquement la <em>scolarité</em></h6>
                <div class="form-group">
                    <input type="number" class="form-control" name="nombre" placeholder="nombre de versements...">
                </div>
                <button class="btn waves-effect waves-light green" type="submit">Diviser</button>
            </form>
        @endif
    </div>
</div>