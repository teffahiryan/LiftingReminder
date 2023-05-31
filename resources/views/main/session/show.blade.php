@extends('base')

@section('title', $session->name)

@section('content')

<h1 class="mb-5"> @yield('title') </h1>
    
@endsection