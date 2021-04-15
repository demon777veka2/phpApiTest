<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\Controller;
use App\Http\Controllers\Api\TaskTwo\AdminPanelController;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        //  $classRegistration = new RegistrationsController;
        // $classRegistration->creatFirstDBdata();
        // //   User::create([

        //          'id' => '2',
        //          'name' => 'admin',
        //          'email' => 'admin@mail.ru',
        //          'type' => 'asd',
        //          'github' => 'sa',
        //         'city' => 'as',
        //         'phone' => 'das',
        //         'birthday' => 3212,  
        //         'post_id' => 1,
        //         'password' => Hash::make('admin'),


        // ]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => true, 'massage' => 'Ошибка ввода данных']);
        }

        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        //проверка на админа
        $userId =  User::where('email', '=', $request['email'])->get('id');
        $userId = preg_replace("/[^0-9]/", '', $userId);


        if ($userId == 2) {
            //заносим инфрормацию о пользователе на сайт

            //заносим инфрормацию о пользователе на сайт
            //$session =  $request->session()->put('login', $token);

            // $session =  $request->session()->put('token', '2');

            $tableUser = User::get();
            return redirect()->action('Api\TaskTwo\AdminPanelController@user');
            return view('AdminPanel', ['tableUser' => $tableUser]);

            //  return view('AdminPanel', ['token' => $session]);
        }



        return response()->json(['status' => 200, 'token' => $token]);
    }

    public function loginAdminView(Request $request)
    {
        return view('Authorization');
    }
}
