<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            @if($session->exists)
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier la séance</h1>
            @else
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle séance</h1>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form class="vstack gap-2" action="{{route($session->exists ? 'user.session.update' : 'user.session.store', $session )}}" method="post" enctype="multipart/form-data">
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
          </div>

        </div>
    </div>
</div>