@extends('layout')

@section('title')Пользователь@endsection

@section('main_content')

    <div style="margin:0 auto; width:50%;float:left;  height: 800px; padding-left: 20%">
    
        <div style="margin:40px 0 40px 0">
            <a href="user-table-add">
                <input class="btn btn-secondary" type="submit" value="Добавить новую запись" name="add">
            </a>
        </div>

        <table class="table table-bordered">
            <tr class="cas">
                <td>Никнейм</td>
                <td>Email</td>
                <td>type</td>
                <td>github</td>
                <td>Город</td>
                <td>Телефон</td>
                <td>Год рождения</td>
                <td>Должность ID</td>
            </tr>

            @foreach($tableUser as $el)
            <tr>
                <td>{{$el->name}}</td>
                <td>{{$el->email }}</td>
                <td>{{$el->type}}</td>
                <td>{{$el->github}}</td>
                <td>{{$el->city}}</td>
                <td>{{$el->phone}}</td>
                <td>{{$el->birthday}}</td>
                <td>{{$el->post_id }}</td>
                <td>
                    <a href='user-table-delete/{{ $el->id }}'>Удалить</a>
                </td>
                <td>
                    <a href='user-table-edit/{{ $el->id }}'>Редактировать</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection