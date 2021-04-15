@extends('layout')

@section('title')Редактирование @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
    <div style="color:red">
        {{ isset($error) ? $error : '' }}
    </div></br>

    <div class="row">
        <form method="post" action="UserTableEdit">
            @foreach($infoPostId as $el)
            @csrf
            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal">

                    <span class="heading">Изменить</span>
                    <div class="form-group">
                        Id <input type="text" class="form-control" value="{{$el->id}}" id="id" name="id" placeholder="name" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group">
                        Никней <input type="text" class="form-control" value="{{$el->name}}" id="name" name="name" placeholder="name" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group help">
                        Id Отдела<input type="text" class="form-control" value="{{$el->otdel_id}}" id="otdel_id" name="otdel_id" placeholder="otdel_id" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <button type="submit" class="btn btn-default">Редактировать</button>
                </form>
            </div>
            @endforeach
        </form>
    </div>
</div>



@endsection