@extends('layout')

@section('title')Добавление @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
    <div style="color:red">
    {{ isset($error) ? $error : '' }}
    </div></br>

    <div class="row">
        <form method="post" action="PostTableAdd">
            @csrf
            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal">

                    <span class="heading"><h2>Создать</h2></span>
                    <div class="form-group">
                        Название <input type="text" class="form-control" id="name" name="name" placeholder="name" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group">
                        Id Отдела <input type="text" class="form-control" id="otdel_id" name="otdel_id" placeholder="otdel_id" style="width:200px;">
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