@extends('base')

@section('title', $exercise->name)

@section('content')

{{-- MODAL EXERCISE UPDATE --}}

@include('main.exercise.formModal')

{{-- TITLE AND OPTIONS --}}

<div class="mt-5">
  <div class="d-flex align-items-center">
      <h1 class=""> Exercice {{$exercise->name}} </h1>
      <div class="dropdown ms-3">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-edit"></i>
          </button>
          <ul class="dropdown-menu">
            <li>
              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exerciseModal"> 
                  <i class="fas fa-pencil-alt"></i> Modifier
              </button>
            </li>
            <li>
              <form action="{{route('user.exercise.destroy', ['exercise' => $exercise])}}" method="post">
                  @csrf
                  @method("delete")
                  <button class="dropdown-item"> <i class="fas fa-trash-alt"></i> Supprimer </button>
              </form>
            </li>
          </ul>
        </div>
  </div>

  <hr class="bg-secondary p-1 rounded" style="border : none;" />
  <p> Modifié le {{$exercise->updated_at->format("d/m/Y")}} </p>

  <div>
    <p> {{$exercise->description}} </p>
  </div>

</div>

    
@endsection