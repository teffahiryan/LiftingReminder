@extends('base')

@section('title', $session->name)

@section('content')

<h1 class="mb-3"> @yield('title') </h1>

<p> {{$session->description}} </p>

<div>
    @foreach ($sessionExercises as $exercise)
    <div class="card m-2">
        <div class="card-body">
          <h5 class="card-title">{{$exercise->name}}</h5>
          <p class="card-text">{{$exercise->description}}</p>
          <div class="d-flex gap-3">

                <div class="d-flex flex-column">
                    <h6> Répétition </h6>
                    <div class="d-flex gap-3">
                        @include('includes.formRSW', ['value' => $exercise->pivot->repetition - 1, 'sign' => '-', 'name' => 'repetition'])

                        <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                            @csrf
                            <input type="text" name="repetition" value="{{$exercise->pivot->repetition}}">
                        </form>

                        @include('includes.formRSW', ['value' => $exercise->pivot->repetition + 1, 'sign' => '+', 'name' => 'repetition'])
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <h6> Série </h6>
                    <div class="d-flex gap-3">
                        @include('includes.formRSW', ['value' => $exercise->pivot->set - 1, 'sign' => '-', 'name' => 'set'])

                        <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                            @csrf
                            <input type="text" name="set" value="{{$exercise->pivot->set}}">
                        </form>

                        @include('includes.formRSW', ['value' => $exercise->pivot->set + 1, 'sign' => '+', 'name' => 'set'])
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <h6> Poids </h6>
                    <div class="d-flex gap-3">
                        @include('includes.formRSW', ['value' => floatval($exercise->pivot->weight) - 1, 'sign' => '-', 'name' => 'weight'])

                        <form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
                            @csrf
                            <input type="text" name="weight" value="{{$exercise->pivot->weight}}">
                        </form>

                        @include('includes.formRSW', ['value' => floatval($exercise->pivot->weight) + 1, 'sign' => '+', 'name' => 'weight'])
                    </div>
                </div>
          </div>
        </div>
    </div>
    @endforeach
    @include('main.exercise_session.formModal')
    <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exercisesessionModal"> 
        <i class="fas fa-plus" style="color: #ffffff;"></i> Ajouter un exercice existant
    </button>
</div>

    
@endsection