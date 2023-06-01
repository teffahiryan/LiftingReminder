<form action="{{route('user.exercise.updateRSW', $exercise->id)}}" method="post">
    @csrf
    <input type="hidden" name="{{$name}}" value="{{$value}}">
    <button class="btn btn-primary">
        {{$sign}}
    </button>
</form>
