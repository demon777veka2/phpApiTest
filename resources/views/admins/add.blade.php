@extends('layout')

@section('title')Добавление @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:70%;">
    <div style="color:red">
    </div></br>
    <div class="row">
        <form method="post" action="add">
            @csrf
            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal">

                    <span class="heading">
                        <h2>Создать</h2>
                    </span>

                    @error('name')
                    <div style="color:red; width:300px;">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        Никней <input type="text" class="form-control" id="name" name="name" placeholder="name" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    @error('email')
                    <div style="color:red; width:300px;">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        Email <input type="text" class="form-control" id="email" name="email" placeholder="email" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Type <input type="text" class="form-control" id="type" name="type" placeholder="type" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    @error('github')
                    <div style="color:red; width:300px;">{{ $message }}</div>
                    @enderror
                    <div class="form-group help">
                        github <input type="text" class="form-control" id="github" name="github" placeholder="github" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Город <input type="text" class="form-control" id="city" name="city" placeholder="city" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    @error('phone')
                    <div style="color:red; width:300px;">{{ $message }}</div>
                    @enderror
                    <div class="form-group help">
                        Телефон <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    @error('birthday')
                    <div style="color:red; width:300px;">{{ $message }}</div>
                    @enderror
                    <div class="form-group help">
                        Год рождения <input type="text" class="form-control" id="birthday" name="birthday" placeholder="birthday" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Роль
                        <select  class="form-control" style="width:200px;" id="role" name="role">
                            <option>user</option>
                            <option>admin</option>
                        </select>
                    </div>

                    <div class="form-group help">
                        Пароль <input type="text" class="form-control" id="password" name="password" placeholder="password" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        Id должности<input type="text" class="form-control" id="post_id" name="post_id" placeholder="post_id" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <button type="submit" class="btn btn-default">Добавить</button>
                </form>
            </div>
        </form>
    </div>
</div>



@endsection