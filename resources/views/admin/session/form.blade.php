@extends('base')

@section('title', $session->exists ? "Editer une séance" : "Créer une séance")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{route($session->exists ? 'session.update' : 'session.store', $session )}}" method="post">
        
        @csrf
        @method($session->exists ? 'put' : 'post')

        @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $session->name])
        @include('shared.input', ['type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $session->description])

        <div>
            <button class="btn btn-primary">
                @if($session->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection