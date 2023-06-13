<form action="{{route('user.session.updateRSW', [$session->id, $exercise->id])}}" method="post">
    @csrf
    <input type="hidden" name="{{$name}}" value="{{$value}}">
    <button class="btn btn-info">
        {{$sign}}
    </button>
</form>
