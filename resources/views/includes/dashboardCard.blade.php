<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{$item->name}}</h5>
        <p class="card-text">{{$item->description}}</p>
        @if ($type === "session")
            <a href="{{route('user.session.show', $item)}}" class="btn btn-primary">Voir</a>
        @else
            <a href="{{route('user.exercise.show', $item)}}" class="btn btn-primary">Voir</a>
        @endif
    </div>
</div>