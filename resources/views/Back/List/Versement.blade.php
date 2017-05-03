<div class="card col s6">
    <div class="card-content">
        <span class="card-title">Les Versements du Niveau Courant</span>
    <table class="table-responsive striped">
        <thead>
        <tr>
            <th>Valeurs</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($versements as $versement)
            <tr>
                <td>{{$versement->valeur}}</td>
                <td><a class="btn waves-effect waves-light blue" href="{{route('versement.edit',$versement)}}"><i class="material-icons">mode_edit</i> Editer</a> </td>
                <td>
                    <form action="{{ URL::route('versement.destroy',$versement) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn waves-effect waves-light red">Supprimer
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-center"><strong>TOTAL DES VERSEMENTS: </strong><blockquote>{{$total}}</blockquote></td>
        </tr>
        </tbody>
    </table>
        <p>{{$versements->links()}}</p>
        <p>
            <a href="{{route('frais.create')}}">Page de gestion de frais...</a>
        </p>
</div>
</div>
