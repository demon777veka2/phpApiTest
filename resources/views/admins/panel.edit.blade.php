@extends('layout')

@section('title')Редактирование @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
    <div style="color:red">
        {{ isset($error) ? $error : '' }}
    </div></br>

    <div class="row">
        <form method="post" action="user-table-edit">
            @foreach($infoUserId as $el)
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

                    <div class="form-group">
                        Email <input type="text" class="form-control" value="{{$el->email}}" id="email" name="email" placeholder="email" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Type <input type="text" class="form-control" value="{{$el->type}}" id="type" name="type" placeholder="type" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group help">
                        github <input type="text" class="form-control" value="{{$el->github}}" id="github" name="github" placeholder="github" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Город <input type="text" class="form-control" value="{{$el->city}}" id="city" name="city" placeholder="city" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Телефон <input type="text" class="form-control" value="{{$el->phone}}" id="phone" name="phone" placeholder="phone" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Год рождения <input type="text" class="form-control" value="{{$el->birthday}}" id="birthday" name="birthday" placeholder="birthday" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Пароль <input type="text" class="form-control" value="{{$el->password}}" id="password" name="password" placeholder="password" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Id должности<input type="text" class="form-control" value="{{$el->post_id}}" id="post_id" name="post_id" placeholder="post_id" style="width:200px;">
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