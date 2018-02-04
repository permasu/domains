@extends('main')


@section('filter')

<br/>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <select class="form-control mb-2">
                            <option>Последний</option>
                            <option>Предпоследний</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <div class="form-check mb-2">

                        <input class="form-check-input" type="checkbox" id="ShowHide">
                            <label class="form-check-label" for="ShowHide">Показать скрытые</label>
                        </div>
                    </div>


                    <div class="col-auto">
                        <div class="form-check mb-2">

                        <input type="checkbox" class="form-check-input" id="OnlyInterested">
                            <label class="form-check-label" for="OnlyInterested">Только интересные</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Применить</button>
                    </div>

                </div>
            </form>
<br/>

@endsection

@section('table')

    <table class="table">
        <th>Название</th>
        <th>этаж</th>
        <th>этажей в доме</th>
        <th>Цена</th>
        <th>район</th>
        <th>Аддресса</th>
        <th>Создано</th>
        @foreach($table as $line)
            <tr>
                <td>
                    <a href={{$line->href}}>{{$line->title}}</a>
                </td>
                <td>  {{$line->etazh}}  </td>
                <td>    {{$line->maxetazh}}</td>
                <td>    {{$line->price}}</td>
                <td>    {{$line->district}}</td>
                <td>    {{$line->address}}</td>
                <td>    {{$line->created_at}}</td>
            </tr>
        @endforeach
    </table>
@endsection
