<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Otdel;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrationsController extends Controller
{
    public function registrations(Request $request)
    {
        $classRegistration = new RegistrationsController;
        $classRegistration->creatFirstDBdata();

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'type' => 'nullable',
            'github' => 'nullable|regex:/github.com([\/A-z]*)/',
            'city' => 'nullable',
            'phone' => 'max:11|nullable|regex:/8[0-9]{10}/',
            'birthday' => 'max:4|regex:/[0-9]{4}/|min:4|nullable',
            'post_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'massage' => 'Ошибка ввода данных'], 407);
        }

        if (empty($request['type'])) $request['type'] = '';
        if (empty($request['github'])) $request['github'] = '';
        if (empty($request['city'])) $request['city'] = '';
        if (empty($request['phone'])) $request['phone'] = '';
        if (empty($request['birthday'])) $request['birthday'] = null;
        if (empty($request['post_id'])) $request['post_id'] = 1;

        $password = bin2hex(random_bytes(5));

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'github' => $request['github'],
            'city' => $request['city'],
            'phone' => $request['phone'],
            'birthday' => $request['birthday'],
            'post_id' => $request['post_id'],
            'password' => Hash::make($password),
        ]);

        return response()->json(['password' => $password], 200);
    }

    public function creatFirstDBdata()
    {
        $bdcheck = User::where('id', '=', 1)->get()->count() > 0;
        if ($bdcheck == null) {

            Otdel::create([
                'id' => 1,
                'name' => 'user'
            ]);

            Position::create([
                'id' => 1,
                'name' => 'user',
                'otdel_id' => '1'
            ]);

            User::create([
                'id' => 1,
                'name' => 'user',
                'email' => 'user@mail.ru',
                'post_id' => 1,
                'password' => Hash::make('user'),
            ]);

            User::create([
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@mail.ru',
                'post_id' => 1,
                'password' => Hash::make('admin'),
            ]);
        }
    }
}
