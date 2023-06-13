@extends('base')

@section('title', $exercise->name)

@section('content')

{{-- TITLE AND OPTIONS --}}

<a href="{{route('shared')}}/#{{"item".$exercise->id}}" class="btn btn-info mt-2"> <i class="fas fa-arrow-circle-left"></i> Retour </a>

<div class="mt-5">
  <div class="d-flex align-items-center">
      <h1 class=""> Exercice partagé - {{$exercise->name}} </h1>
  </div>

  <hr class="bg-secondary p-1 rounded" style="border : none;" />
  <p> Par {{$exercise->user->name}} </p>

  <div>
    <p> {{$exercise->description}} </p>
  </div>

</div>

    
@endsection