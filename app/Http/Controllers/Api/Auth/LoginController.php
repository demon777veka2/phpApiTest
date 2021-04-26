<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\Controller;
use App\Http\Controllers\Api\TaskTwo\AdminPanelController;
use Illuminate\Http\Request;
use App\Models\Position;
use App\User;
//use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;



class LoginController extends Controller
{
    public function login(Request $request)
    {
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

        return response()->json(['status' => 200, 'token' => $token]);
    }

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return view('Authorization', ['error' => 'Ошибка ввода данных']);
        }

        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return view('Authorization', ['error' => 'Unauthorized']);
        }

        //проверка на админа
        $userId =  User::where('email', '=', $request['email'])->get('id');
        $userId = preg_replace("/[^0-9]/", '', $userId);

        if ($userId == 2) {
            //заносим инфрормацию о пользователе на сайт
            Session(['userId' => $userId]);
            $tableUser = User::get();

            return view('AdminPanel', ['tableUser' => $tableUser]);
        }

        return view('Authorization', ['error' => 'Вы не админ']);
    }

    public function loginAdminView()
    {
        $classRegistration = new RegistrationsController;
        $classRegistration->creatFirstDBdata();

        return view('Authorization');
    }

    public function restore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => true, 'massage' => 'Ошибка ввода данных']);
        }

        $user = User::where('email', $request['email'])->first();
        $token = JWTAuth::fromUser($user);

        return response()->json(['status' => 200, 'token' => $token]);
    }

    public function restoreConfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return view('Authorization', ['error' => 'Ошибка ввода данных']);
        }

        if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        $idUser = JWTAuth::parseToken()->authenticate()->id;

        $infoUser = User::find($idUser);
        $request['password'] = Hash::make($request['password']);
        $infoUser->update($request->all());

        return response()->json('The user has successfully changed the password', 200);

    }
}
