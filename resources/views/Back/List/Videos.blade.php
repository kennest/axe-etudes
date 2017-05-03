<div class="card col s12">
    <div class="card-content">
        <span class="card-title">Vos Videos</span>
        @foreach($galeries as $galery)
            @foreach($galery->videos()->get() as $video)
                @if($video->id)
                    {{$video->path}}
                @else
                    <p>Pas de Videos</p>
                @endif
            @endforeach
        @endforeach
    </div>
</div>