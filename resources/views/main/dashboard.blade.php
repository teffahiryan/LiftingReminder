@extends('base')

@section('title', 'Tableau de bord')

@section('content') 
    
<div class="mt-5">
    <h1 class=""> Bienvenue {{ Auth::user()->name }} ! </h1>
    <hr class="bg-secondary p-1 rounded" style="border : none;" />
</div>

{{-- TIPS --}}

<div class="bg-info text-light text-center p-2 rounded mt-4 mb-5 w-75 mx-auto">
    <span class="fw-bold"> Conseil du jour : </span> {{$tips->desc}}
</div>

{{-- SESSIONS --}}

@include('main.session.formModal')

<div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <h3> Vos séances </h3>
        <button class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#sessionModal"> 
            <i class="fas fa-plus" style="color: #ffffff;"></i> Nouvelle séance 
        </button>
    </div>
    <div class="container">
        <div class="row row-cols-3">
            @foreach ($sessions as $session)
                @include('includes.dashboardCard', ['item' => $session, 'type' => 'session'])
            @endforeach
        </div>
    </div>
</div>

{{-- EXERCISES --}}

@include('main.exercise.formModal')

<div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <h3> Vos exercices </h3>
        <button class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#exerciseModal"> 
            <i class="fas fa-plus" style="color: #ffffff;"></i> Nouvel exercice
        </button>
    </div>
    <div class="container">
        <div class="row row-cols-3">
            @foreach ($exercises as $exercise)
                @include('includes.dashboardCard', ['item' => $exercise, 'type' => 'exercise'])
            @endforeach
        </div>
    </div>
</div>
 
@endsection