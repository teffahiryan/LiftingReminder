@extends('base')

@section('title', 'Accueil')

@section('content')
    
    <h1> Conseil </h1>

    <a href="{{route('tips.create')}}" class="btn btn-primary">Créer</a>

    <table class="table table-striped">
        <thead>
            <th>Description</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($tips as $tip)
                <tr>
                    <td> {{$tip->desc}} </td>
                    <td class="d-flex gap-2">
                        <a href="{{route('tips.edit', $tip)}}" class="btn btn-primary">Modifier</a>
                        <form action="{{route('tips.destroy', $tip)}}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($tips->isEmpty())
        <div class="text-center"> Aucun résultats trouvé </div>
    @endif

@endsection