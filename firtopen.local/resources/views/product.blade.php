
@extends('layouts.main')
@section('content')
<p>

<p>{{$good->name}}</p>
<p>{{$good->description}}</p>
<p>{{$good->price}}</p>
		

</p>
<form action="/order/{{$good->id}}">

	<input type="submit" onclick="submit" value="order1" class="btn btn-primary">
	
</form>
@endsection	
	
	