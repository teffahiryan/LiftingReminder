<div class="modal fade" id="exerciseModal" tabindex="-1" aria-labelledby="exerciseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvel exercice</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form class="vstack gap-2" action="{{route($exercise->exists ? 'user.exercise.update' : 'user.exercise.store', $exercise )}}" method="post">
                @csrf
                @method($exercise->exists ? 'put' : 'post')

                @include('shared.input', ['class' => 'col', 'label' => 'Nom', 'name' => 'name', 'value' => $exercise->name])
                @include('shared.input', ['type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $exercise->description])
                @include('shared.input', ['class' => 'col', 'label' => 'Série', 'name' => 'set', 'value' => $exercise->name])
                @include('shared.input', ['class' => 'col', 'label' => 'Répétition', 'name' => 'repetition', 'value' => $exercise->name])

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