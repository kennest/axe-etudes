<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Liste des Dossiers requis par votre etablissement</span>
    <table class="table-responsive striped">
        <thead>
        <tr>
            <th>Libelle</th>
            <th>frais</th>
            <th>Type</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dossiers as $dossier)
            <tr>
                <td>{{$dossier->libelle}}</td>
                <td>{{$dossier->frais?$dossier->frais:'0'}}</td>
                <td>{{$dossier->types}}</td>
                <td><a class="btn waves-effect waves-light blue" href="{{route('dossier.edit',$dossier)}}"><i class="material-icons">mode_edit</i>Editer</a></td>
                <td>
                    <form action="{{ URL::route('dossier.destroy',$dossier) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn waves-effect waves-light red">Supprimer
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