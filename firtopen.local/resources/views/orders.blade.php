
@extends('layouts.main')
@section('content')
<form action ="/order_final" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div>
		<input type="text" name="customer_name" class="form-control"/>
	</div>
	<div>
		<input type="text" name="phone" class="form-control"/>
	</div>
	<div>
		<input type="text" name="city" class="form-control"/>
	</div>
	<div>
		<textarea class="form-control" name="comment">comment</textarea>
	</div>
	<div>
		<input type="number" name="amount" class="form-control"/>
	</div>

	<input type="hidden" value="{{$goods_id}}" name="product_id"/>
	<input type="submit" onclick="submit" value="order" class="btn btn-success"/>
	
</form>
@endsection	
	
	