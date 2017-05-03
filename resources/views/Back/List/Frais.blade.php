<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos differents Frais</span>
    <table class="responsive-table striped">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Frais</th>
            <th>Scolarite</th>
            <th>Nombre de Versements</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_frais as $frais)
            <tr>
                <td class="text-center"><strong>{{strtoupper($frais->niveau()->first()->titre)}}</strong></td>
                <td>{{$frais->frais}}</td>
                <td>{{$frais->scolarite}}</td>
                <td>
                    <a class="waves-effect waves-light" href="{{route('versement.create',$frais->id)}}">
                        <strong>{{$frais->versements()->count()}} versement(s)</strong>
                    </a>
                </td>
                <td><a href="{{route('frais.edit',$frais)}}" class="">Editer</a></td>
                <td>
                    <form action="{{ URL::route('frais.destroy',$frais) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn waves-effect waves-light red">
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>