@if($errors->any())

            @foreach($errors->all() as $error)
                <div class="chip">
                {{$error}}
                    <i class="close material-icons">close</i>
                </div>
            @endforeach

@endif
@if(Session::get('actif'))
    <div class="chip">
        {{Session::get('actif')}}
        <i class="close material-icons">close</i>
    </div>
@endif