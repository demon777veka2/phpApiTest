@extends('layout')

@section('title')Регистрация @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
    <div style="color:red">
        {{ isset($error) ? $error : '' }}
    </div></br>

    <div class="row">
        <form method="post" action="/registration">
            @csrf
            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal">

                    <span class="heading">Регистрация</span>
                    <div class="form-group">
                        <input type="login" class="form-control" id="login" name="login" placeholder="Login" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group help">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <div class="form-group help">
                        <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Repeat password" style="width:200px;">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>

                    <a href="/registration"><button type="submit" class="btn btn-default">Зарегистрироваться</button></a>

                </form>
            </div>
        </form>
    </div>
</div>



@endsection