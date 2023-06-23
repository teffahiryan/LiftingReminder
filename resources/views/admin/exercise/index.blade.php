@extends('admin.base')

@section('title', 'Exercice')

@section('content')
    
    <h1> Exercice </h1>

    <a href="{{route('admin.exercise.create')}}" class="btn btn-primary">Créer</a>

    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
                <tr>
                    <td> {{$exercise->name}} </td>
                    <td> {{$exercise->description}} </td>
                    <td class="d-flex gap-2">
                        <a href="{{route('admin.exercise.show', $exercise)}}" class="btn btn-primary">Voir</a>
                        <a href="{{route('admin.exercise.edit', $exercise)}}" class="btn btn-primary">Modifier</a>
                        <form action="{{route('admin.exercise.destroy', $exercise)}}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($exercises->isEmpty())
        <div class="text-center"> Aucun résultats trouvé </div>
    @endif

@endsection