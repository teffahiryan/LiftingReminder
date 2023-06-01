@extends('base')
@section('title', 'Exercice')
@section('content')
    <h1> Exercice {{$exercise->name}} </h1>
    <ul class="list-group">
        <li class="list-group-item">{{$exercise->name}}</li>
        <li class="list-group-item">{{$exercise->description}}</li>
        <li class="list-group-item">{{$exercise->set}}</li>
        <li class="list-group-item">{{$exercise->repetition}}</li>
    </ul>
@endsection