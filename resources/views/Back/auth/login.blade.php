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
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="title">Connectez-vous!</div>
    @include('errors.validation')
    @include('success.register')
{!! Form::open(['route' => 'dash_login_form'])!!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="actif" value="0">
<div class="form-group">
    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email...']) !!}
</div>
<div class="form-group">
    {!! Form::password('password',['class'=>'form-control','placeholder'=>'password...']) !!}
</div>

<div class="form-group">
    {!! Form::checkbox('remember', "Se souvenir de Moi", true) !!}
</div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        Login
                    </button>
                    <a href="">Vous avez oublier votre mot de passe?</a>
                </div>
            </div>
        {!! Form::close()!!}
      </div>
    </body>
    </html>
