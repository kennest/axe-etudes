<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos Filieres</span>
    <table class="responsive-table striped">
        <thead>
        <tr>
            <th>Titre</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user_filieres as $filiere)
            <tr>
                <td class="text-center">{{$filiere->titre}}</td>
                <td>
                    <form action="{{ URL::route('filiere.destroy',$filiere) }}" method="POST">
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
        <p>{{$user_filieres->links()}}</p>
    </div>
</div>

