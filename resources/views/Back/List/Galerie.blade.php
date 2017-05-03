<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos Galeries</span>
        <table class="responsive-table striped">
            <thead>
            <tr>
                <th>titre</th>
                <th>Nombre de photos</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($galeries as $galerie)
                    <tr>
                        <td>{{$galerie->titre}}</td>
                        <td>{{$galerie->photos()->count()}}</td>
                        <td><a class="btn waves-effect waves-light blue" href="{{route('galerie.edit',$galerie)}}">Editer<i class="material-icons">mode_edit</i></a></td>
                        <td>
                            <form action="{{ URL::route('galerie.destroy',$galerie) }}" method="POST">
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
        <p>
            {{$galeries->links()}}
        </p>
        <p>
            <a href="{{route('galerie.createPhoto')}}">Uploader des photos...</a>
        </p>
    </div>
</div>