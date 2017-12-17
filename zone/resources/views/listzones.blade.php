@extends('layouts/main')
@section('content')

    {{--}}
        <form action="addzone" method="post">
            <table class="table">

                <th>Def зоны</th>
                <th>N зоны</th>
                <th>ТЕлефон беглеца</th>
                @foreach(App\zones_change::all() as $zone)

                    <tr>
                        <td>
                            {{$zone->Def}}
                        </td>
                        <td>
                            {{$zone->Zone}}
                        </td>

                        <td>
                            {{$zone->Number}}
                        </td>
                    </tr>
                @endforeach


            </table>

        </form>


        <input type="submit" class="float-right" value="Добавить">
    {{--}}


    {{--}}
    <router-link to="/">        Our company</router-link>

    <router-link to="/people">  People</router-link>
    {{--}}



        <router-link to="/foo">Go to Foo</router-link>
        <router-link to="/bar">Go to Bar</router-link>
        <router-link to="/people"> People</router-link>
        <router-view></router-view>



@endsection
