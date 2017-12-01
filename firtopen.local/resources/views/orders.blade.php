
@extends('layouts.main')
@section('content')
<form action /order/>
	<input type="hidden" value="{{$goods_id}}" name="product_id"/>
	<input type="button" onclick="submit" value="order" class="btn btn-success"/>
	
</form>
@endsection	
	
	