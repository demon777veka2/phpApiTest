@extends('layout')

@section('title')Авторизация @endsection

@section('main_content')


<div class="container" style="margin:0 25% 0 25%; width:50%;">
   <div class="row" style="margin-top:50px;">

      <form method="post" action="admin">
         @csrf
         <div class="col-md-offset-3 col-md-6" style='width:700px'>
            <div style="color:red">{{ isset($error) ? $error : '' }}</div>

            <form class="form-horizontal">
               <span class="heading">АВТОРИЗАЦИЯ</span>
               <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Login" style="width:200px;">
                  <i class="fa fa-user"></i>
               </div>

               <div class="form-group help">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width:200px;">
                  <i class="fa fa-lock"></i>
                  <a href="#" class="fa fa-question-circle"></a>
               </div>

               <a><button type="submit" class="btn btn-default">ВХОД</button> </a>
         </div>
      </form>
   </div>
   </form>
</div>
</div>


@endsection