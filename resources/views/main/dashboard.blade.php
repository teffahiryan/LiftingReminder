@extends('base')

@section('title', 'Tableau de bord')

@section('content')
    
<h1 class="mb-5"> Bienvenue {{ Auth::user()->name }} </h1>

{{-- SESSIONS --}}

@include('main.session.formModal')

<div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <h3> Vos séances > </h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sessionModal"> 
            <i class="fas fa-plus" style="color: #ffffff;"></i> Nouvelle séance 
        </button>
    </div>
    <div class="d-flex flex-row gap-3">
        @foreach ($sessions as $session)
            @include('includes.dashboardCard', ['item' => $session, 'type' => 'session'])
        @endforeach
    </div>
</div>

{{-- EXERCISES --}}

@include('main.exercise.formModal')

<div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <h3> Vos exercices > </h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exerciseModal"> 
            <i class="fas fa-plus" style="color: #ffffff;"></i> Nouvel exercice
        </button>
    </div>
    <div class="d-flex flex-row gap-3">
        @foreach ($exercises as $exercise)
            @include('includes.dashboardCard', ['item' => $exercise, 'type' => 'exercise'])
        @endforeach
    </div>
</div>
 
@endsection