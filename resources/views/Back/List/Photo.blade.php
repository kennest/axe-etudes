<div class="card col s7">
    <div class="card-content">
        <span class="card-title">Vos Photos</span>
    <table class="responsive-table striped">
        <thead>
        <tr>
            <th>Photos</th>
            <th>Galerie</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($galeries as $galerie)
        @foreach($galerie->photos()->get() as $photo)
            <tr>
                <td>
                    <a href="{{route('photo.edit',$photo)}}" class="waves-effect waves-light">
                    <img height="100" width="80" src="{{Storage::url($photo->path)}}">
                    </a>
                </td>
                <td>
                    {{$galerie->titre}}
                </td>
                <td>
                    <form action="{{ URL::route('photo.destroy',$photo) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn waves-effect waves-light red">Supprimer
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        @endforeach
        </tbody>
    </table>
    {{$galeries->links()}}
    </div>
</div>