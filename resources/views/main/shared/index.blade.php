@extends('base')

@section('title', 'Tableau de bord')

@section('content')
    
<div class="mt-5 mb-5">
    <h1 class=""> Les exercices de la communauté </h1>
    <hr class="bg-secondary p-1 rounded" style="border : none;" />
</div>

@if($exercises)
    <div class="container">
        <div class="row row-cols-3">
            @foreach ($exercises as $exercise)
                @include('includes.dashboardCard', ['item' => $exercise, 'type' => 'shared'])
            @endforeach
        </div>
    </div>
@endif
 
@endsection