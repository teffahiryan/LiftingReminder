@extends('base')

@section('title', 'Accueil')

@section('content')
    
    <h1> Séance </h1>

    <a href="{{route('session.create')}}" class="btn btn-primary">Créer</a>

    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td> {{$session->name}} </td>
                    <td> {{$session->description}} </td>
                    <td> # </td>
                    <td>
                        <a href="{{route('session.show', $session)}}" class="btn btn-primary">Voir</a>
                        <a href="{{route('session.edit', $session)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{route('session.destroy', $session)}}" class="btn btn-primary">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($sessions->isEmpty())
        <div class="text-center"> Aucun résultats trouvé </div>
    @endif

@endsection