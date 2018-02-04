@extends('main')
@section('content')
    <form action="/parser" method="post">


        <input type="submit" value="Погнали">
    </form>
    <form action="/reprice" method="get">
        <input type="submit" value="Цены">

    </form>
@endsection
