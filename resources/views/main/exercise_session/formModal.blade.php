<div class="modal fade" id="exercisesessionModal" tabindex="-1" aria-labelledby="exercisesessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Choix d'exercices</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">

            @php
                $exercisesIds = $session->exercises()->pluck('id');
            @endphp

            <form class="vstack gap-2" action="{{route('user.session.updateExercise', $session )}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="exercise"> Exercices </label>
                    <select class="form-control" id="exercise" name="exercises[]" multiple>
                        @foreach ($exercises as $exercise)
                            <option @selected($exercisesIds->contains($exercise->id)) value="{{$exercise->id}}">{{$exercise->name}}</option>
                        @endforeach
                    </select>
                    @error("exercises")
                        {{$message}}
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