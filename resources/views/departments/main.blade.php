@extends('layout')

@section('title')Отдел@endsection

@section('main_content')

<div style="margin:0 auto; width:50%;float:left;  height: 800px; padding-left: 20%">

    <div style="margin:40px 0 40px 0">
        <a href="otdel-table-add">
            <input class="btn btn-secondary" type="submit" value="Добавить новую запись" name="add">
        </a>
    </div>
    <table class="table table-bordered">
        <tr class="cas">
            <td>name</td>
        </tr>

        @foreach($tableOtdel as $el)
        <tr>
            <td>{{$el->name}}</td>
            <td>
                <a href='otdel-table-delete/{{ $el->id }}'>Удалить</a>
            </td>
            <td>
                <a href='otdel-table-edit/{{ $el->id }}'>Редактировать</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection