@extends('layout')

@section('title')Должность@endsection

@section('main_content')
<div style="margin:0 auto; width:50%;float:left;  height: 800px; padding-left: 20%">

    <div style="margin:40px 0 40px 0">
        <a href="PostTableAdd">
            <input class="btn btn-secondary" type="submit" value="Добавить новую запись" name="add">
        </a>
    </div>

    <table class="table table-bordered">
        <tr class="cas">
            <td>Название</td>
            <td>Id Отдела</td>
        </tr>

        @foreach($tablePost as $el)
        <tr>
            <td>{{$el->name}}</td>
            <td>{{$el->otdel_id}}</td>
            <td>
                <a href='PostTableDelete/{{ $el->id }}'>Удалить</a>
            </td>
            <td>
                <a href='PostTableEdit/{{ $el->id }}'>Редактировать</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection