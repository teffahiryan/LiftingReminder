<div class="modal fade" id="exerciseModal" tabindex="-1" aria-labelledby="exerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            @if($exercise->exists)
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier l'exercice</h1>
            @else
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvel exercice</h1>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form class="vstack gap-2" action="{{route($exercise->exists ? 'user.exercise.update' : 'user.exercise.store', $exercise)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method($exercise->exists ? 'put' : 'post')

                @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $exercise->name])
                @include('shared.input', ['type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $exercise->description])

                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @if ($exercise->image)
                        <img src="{{$exercise->imageUrl()}}" class="rounded mt-2" style="width: 75px; height: 75px; object-fit: cover;" alt="{{$exercise->name}}">
                    @endif
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>

                @include('shared.checkbox', ['name' => 'isShared', 'label' => 'Partager à la communauté', 'value' => $exercise->isShared])

                <div>
                    <button class="btn btn-primary">
                        @if($exercise->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>

            </form>
          </div>

        </div>
    </div>
</div>