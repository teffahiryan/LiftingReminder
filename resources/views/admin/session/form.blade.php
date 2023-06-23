@extends('admin.base')

@section('title', $session->exists ? "Editer une séance" : "Créer une séance")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{route($session->exists ? 'admin.session.update' : 'admin.session.store', $session )}}" method="post" enctype="multipart/form-data">
        
        @csrf
        @method($session->exists ? 'put' : 'post')

        @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $session->name])
        @include('shared.input', ['type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $session->description])

        
        <div class="mb-3">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image">
            @if ($session->image)
                <img src="{{$session->imageUrl()}}" class="rounded mt-2" style="width: 75px; height: 75px; object-fit: cover;" alt="{{$session->name}}">
            @endif
            @error('image')
                {{ $message }}
            @enderror
        </div>

        <div>
            <button class="btn btn-primary">
                @if($session->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection