@extends('base')

@section('title', 'Exercice')

@section('content')
    
    <h1> Exercice </h1>

    <a href="{{route('exercise.create')}}" class="btn btn-primary">Créer</a>

    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>Série</th>
            <th>Répétition</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
                <tr>
                    <td> {{$exercise->name}} </td>
                    <td> {{$exercise->description}} </td>
                    <td> {{$exercise->set}} </td>
                    <td> {{$exercise->repetition}} </td>
                    <td>
                        <a href="{{route('exercise.show', $exercise)}}" class="btn btn-primary">Voir</a>
                        <a href="{{route('exercise.edit', $exercise)}}" class="btn btn-primary">Modifier</a>
                        <a href="{{route('exercise.destroy', $exercise)}}" class="btn btn-primary">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($exercises->isEmpty())
        <div class="text-center"> Aucun résultats trouvé </div>
    @endif

@endsection