<html>
<head>
    <title>
        Axe-etudes | Enregistrement
    </title>
    <!-- Latest compiled and minified CSS -->
    {!! Html::style('Front/bootstrap/bootstrap.css') !!}
    {!! Html::style('auth/admin/style.css') !!}
</head>
<body>
<div class="content">
    <div class="title">Enregistrez-vous!</div>
    @include('errors.validation')
    @include('success.register')
    {!! Form::model($etablissement,['route' => 'dash_register','files'=>true])!!}
    <div class="form-group">
        <p>Types:</p>
        {!! Form::select('types',$types->pluck('titre','id'),null,['class'=>'form-control']) !!}<br/>
    </div>
    <div class="form-group">
        {!! Form::text('titre',null,['class'=>'form-control','placeholder'=>'Titre...']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('sigle',null,['class'=>'form-control','placeholder'=>'Sigle (Ex: ITES, ISFOP , ESATIC)...']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email...']) !!}
    </div>

    <div class="form-group">
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Mot de passe...']) !!}
    </div>
    <div class="form-group">
        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Retaper Mot de passe...']) !!}
    </div>

    <input type="hidden" name="slug">
    <input type="hidden" name="statut">
    <input type="hidden" name="code">
    <input type="hidden" name="type_id">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        {!! Form::text('telephone',null,['class'=>'form-control','placeholder'=>'Telephone...']) !!}
    </div>
    <div class="form-group">
        {!! Form::file('logo',null,['class'=>'form-control','placeholder'=>'Logo...']) !!}
        <span class="label label-info">Taille max=250Ko</span>
    </div>
    <div class="form-group">
        {!! Form::text('ville',null,['class'=>'form-control','placeholder'=>'Ville...']) !!}
    </div>
    <div class="form-group">
        <input type="checkbox" name="policy" class="form-control"/><span><h5>J'ai lu et accepté les <a href="#">Conditions d'utilisations</a> et <a href="#">Politique de confidentialité</a></h5></span>
    </div>
    <button class="btn btn-primary">S'enregistrer</button>
    {!! Form::close()!!}
</div>
</body>
</html>
