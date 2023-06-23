@extends('admin.base')

@section('title', 'Séance')

@section('content')
    
    <h1> Séance </h1>

    <a href="{{route('admin.session.create')}}" class="btn btn-primary">Créer</a>

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
                    <td class="d-flex gap-2">
                        <a href="{{route('admin.session.show', $session)}}" class="btn btn-primary">Voir</a>
                        <a href="{{route('admin.session.edit', $session)}}" class="btn btn-primary">Modifier</a>
                        <form action="{{route('admin.session.destroy', $session)}}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($sessions->isEmpty())
        <div class="text-center"> Aucun résultats trouvé </div>
    @endif

@endsection