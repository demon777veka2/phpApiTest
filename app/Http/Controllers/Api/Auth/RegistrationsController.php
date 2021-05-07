<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Models\Department;
use App\Models\Otdel;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegistrationsController extends Controller
{
    public function registrations(AdminAddRequest $request)
    {
        $password = bin2hex(random_bytes(5));

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'] ?? '',
            'github' => $request['github'] ?? '',
            'city' => $request['city'] ?? '',
            'phone' => $request['phone'] ?? null,
            'birthday' => $request['birthday'] ?? '',
            'post_id' => $request['post_id'] ?? 1,
            'password' => Hash::make($password),
        ]);

        return response()->json(['password' => $password], 200);
    }
}
