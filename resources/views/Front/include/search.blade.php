{{Form::open(['route'=>'doSearch'])}}
<br/>
<div class="input-group">
{!! Form::text('word',null,['class'=>'form-control','placeholder'=>'Rechercher sur Axe-Etude...']) !!}
<span class="input-group-btn">
<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
</span>
</div>
{{Form::close()}}