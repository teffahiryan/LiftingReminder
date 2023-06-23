@extends('admin.base')

@section('title', $exercise->exists ? "Editer un exercice" : "Créer un exercice")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{route($exercise->exists ? 'admin.exercise.update' : 'admin.exercise.store', $exercise )}}" method="post">
        
        @csrf
        @method($exercise->exists ? 'put' : 'post')

        @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $exercise->name])
        @include('shared.input', ['type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $exercise->description])
        @include('shared.input', ['class' => 'col', 'label' => 'Série', 'name' => 'set', 'value' => $exercise->name])
        @include('shared.input', ['class' => 'col', 'label' => 'Répétition', 'name' => 'repetition', 'value' => $exercise->name])

        <div>
            <button class="btn btn-primary">
                @if($exercise->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection