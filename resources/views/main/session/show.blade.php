@extends('base')

@section('title', $session->name)

@section('content')

{{-- MODAL SESSION UPDATE --}}

@include('main.session.formModal')

{{-- TITLE AND OPTIONS --}}

<div class="mt-5">
    <div class="d-flex align-items-center">
        <h1 class=""> Séance {{$session->name}} </h1>
        <div class="dropdown ms-3">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-edit"></i>
            </button>
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#sessionModal"> 
                    <i class="fas fa-pencil-alt"></i> Modifier
                </button>
              </li>
              <li>
                <form action="{{route('user.session.delete', ['session' => $session])}}" method="post">
                    @csrf
                    @method("delete")
                    <button class="dropdown-item"> <i class="fas fa-trash-alt"></i> Supprimer </button>
                </form>
              </li>
            </ul>
          </div>
    </div>
    <hr class="bg-secondary p-1 rounded" style="border : none;" />
    <p> {{count($sessionExercises)}} {{count($sessionExercises) > 1 ? 'exercices' : 'exercice'}} - Modifié le {{$session->updated_at->format("d/m/Y")}} </p>
</div>

{{-- BUTTONS EXERCISES --}}

<div class="d-flex">
    <button class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#exercisesessionModal"> 
        <i class="fas fa-plus" style="color: #ffffff;"></i> (Dé)Sélectionner un exercice
    </button>

    {{-- <button class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#exercisesessionModal"> 
        <i class="fas fa-plus" style="color: #ffffff;"></i> Créer un exercice
    </button> --}}

</div>

{{-- DESC --}}

<p> {{$session->description}} </p>

{{-- SHOW EXERCISES --}}

<div>
    @foreach ($sessionExercises as $exercise)
    <div class="card m-2">
        <div class="card-body d-flex justify-content-between">
            {{-- IMG --}}
                <img src="/storage/session/RrUM2G0MPdZQt3nAUdJRWIPQDHpUxKUdUN16crwd.jpg" class="rounded-circle w-25" alt="Image par défaut"> 
            {{-- DESC --}}
            <div class="w-50">
                <h5 class="card-title">{{$exercise->name}}</h5>
                <p class="card-text">{{$exercise->description}}</p>
            </div>
            {{-- RSW --}}
            <div class="w-50 d-flex flex-column justify-content-center align-items-center gap-3">

                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <h6 class="text-center"> Répétition </h6>
                        <div class="d-flex gap-3 m-2">
                            @include('includes.formRSW', ['value' => $exercise->pivot->repetition - 1, 'sign' => '-', 'name' => 'repetition'])

                            <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                                @csrf
                                <input style="width: 50px; text-align: center" type="text" name="repetition" value="{{$exercise->pivot->repetition}}">
                            </form>

                            @include('includes.formRSW', ['value' => $exercise->pivot->repetition + 1, 'sign' => '+', 'name' => 'repetition'])
                        </div>
                    </div>

                    <div class="d-flex flex-column">
                        <h6 class="text-center"> Série </h6>
                        <div class="d-flex gap-3 m-2">
                            @include('includes.formRSW', ['value' => $exercise->pivot->set - 1, 'sign' => '-', 'name' => 'set'])

                            <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                                @csrf
                                <input style="width: 50px; text-align: center" type="text" name="set" value="{{$exercise->pivot->set}}">
                            </form>

                            @include('includes.formRSW', ['value' => $exercise->pivot->set + 1, 'sign' => '+', 'name' => 'set'])
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <h6 class="text-center"> Poids </h6>
                    <div class="d-flex gap-3 m-2">
                        @include('includes.formRSW', ['value' => floatval($exercise->pivot->weight) - 1, 'sign' => '-', 'name' => 'weight'])

                        <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                            @csrf
                            <input style="width: 50px; text-align: center" type="text" name="weight" value="{{$exercise->pivot->weight}}">
                        </form>

                        @include('includes.formRSW', ['value' => floatval($exercise->pivot->weight) + 1, 'sign' => '+', 'name' => 'weight'])
                    </div>
                </div>
          </div>
          {{-- END --}}
        </div>
    </div>
    @endforeach
    @include('main.exercise_session.formModal')
</div>

    
@endsection