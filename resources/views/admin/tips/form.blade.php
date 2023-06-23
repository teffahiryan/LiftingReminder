@extends('admin.base')

@section('title', $tip->exists ? "Editer une séance" : "Créer une séance")

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{route($tip->exists ? 'admin.tip.update' : 'admin.tip.store', $tip )}}" method="post" enctype="multipart/form-data">
        
        @csrf
        @method($tip->exists ? 'put' : 'post')

        @include('shared.input', ['type'=> 'textarea', 'class' => 'col','label' => 'Description' ,'name' => 'desc', 'value' => $tip->desc])

        <div>
            <button class="btn btn-primary">
                @if($tip->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection