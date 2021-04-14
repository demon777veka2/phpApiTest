<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrationsController extends Controller
{
    public function registrations(Request $request)
    {
        if (empty($request['type'])) $request['type'] = '';
        if (empty($request['github'])) $request['github'] = '';
        if (empty($request['city'])) $request['city'] = '';
        if (empty($request['phone'])) $request['phone'] = '';
        if (empty($request['birthday'])) $request['birthday'] = null;
        if (empty($request['otdel_id'])) $request['otdel_id'] = 1;

        $password = bin2hex(random_bytes(5));

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'github' => $request['github'],
            'city' => $request['city'],
            'phone' => $request['phone'],
            'birthday' => $request['birthday'],
            'otdel_id' => $request['otdel_id'],
            'password' => Hash::make($password),
        ]);

        return response()->json(['status' => 200, 'password' => $password]);
    }
}
