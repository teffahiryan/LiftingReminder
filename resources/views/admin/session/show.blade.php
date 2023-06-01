@extends('base')
@section('title', 'Séance')
@section('content')
    <h1> Séance {{$session->name}} </h1>
    <ul class="list-group">
        <li class="list-group-item">{{$session->name}}</li>
        <li class="list-group-item">{{$session->description}}</li>
        <li class="list-group-item">{{$session->image ?? ''}}</li>
    </ul>
@endsection