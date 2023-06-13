
<div id={{"item".$item->id}} class="col mb-3">

    @if ($type == "exercise")
        <a class="card text-dark cardHover" href="{{route('user.exercise.show', $item)}}">
    @elseif($type == "session")
        <a class="card text-dark cardHover" href="{{route('user.session.show', $item)}}">
    @else
        <div class="card">
    @endif

    <div class="card-body">

        <div class="d-flex mb-2">
            {{-- NAME / DESC --}}
            <div class="d-flex flex-column w-50">
                <h4 class="card-title">{{Str::limit($item->name, 15)}}</h4>
                @if ($type == 'session')
                    <p class="fst-italic p-0"> 
                        {{count($item->exercises)}} {{count($item->exercises) > 1 ? 'exercices' : 'exercice'}} 
                    </p>
                @endif
            </div>
            {{-- IMG --}}
            <div class="d-flex justify-content-end w-50">
                <div class="frame">
                    @if ($item->image)
                        <img src="{{$item->imageUrl()}}" class="rounded-circle" alt="{{$item->name}}"> 
                    @else
                        <img src="/storage/session/RrUM2G0MPdZQt3nAUdJRWIPQDHpUxKUdUN16crwd.jpg" class="rounded-circle" alt="Image par défaut"> 
                    @endif
                </div>
            </div>
        </div>
        
        <p class="card-text">{{Str::limit($item->description, 35)}}</p>

        <p class="fst-italic text-end" style="font-size: 0.8em">
            @if($type == 'session' || $type == 'exercise')
                Modifié le {{$item->updated_at->format("d/m/Y")}} 
            @else
                Par {{$item->user->name}}
            @endif
        </p>

        @if($type === 'shared')
            <div class="d-flex gap-2">
                <a class="btn btn-secondary text-light w-50" href="{{route('shared.show', $item)}}"> Voir </a>
                {{-- VOTRE EXERCICE --}}
                @if($item->user->id === auth()->id())
                    <button class="btn btn-secondary text-light w-50"> <i class="fas fa-check"></i> Votre exercice </button>

                {{-- EXERCICE DEJA COPIE --}}
                @elseif($item->user->id === auth()->id())
                    <button class="btn btn-secondary text-light w-50"> <i class="fas fa-check"></i> Déjà ajouté </button>

                {{-- COPIER --}}
                @elseif($type === "shared")
                    <a href="{{route('user.exercise.copy', $item)}}" class="btn btn-secondary text-light w-50">Ajouter</a>
                @endif
            </div>
        @endif
    </div>

    @if ($type == "exercise" || $type == "session")
        </a>
    @else
        </div>
    @endif

</div>