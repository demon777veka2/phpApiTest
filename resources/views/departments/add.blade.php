@extends('layout')

@section('title')Добавление @endsection

@section('main_content')


<div class="container" style=" margin:0 25% 0 25%; width:50%;">
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
                        Название <input type="text" class="form-control" id="name" name="name" placeholder="name" style="width:200px;">
                        <i class="fa fa-user"></i>
                    </div>

                    <button type="submit" class="btn btn-default">Добавить</button>
                </form>
            </div>
        </form>
    </div>
</div>



@endsection