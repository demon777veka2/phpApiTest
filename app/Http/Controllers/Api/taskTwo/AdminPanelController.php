<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminPanelController extends Controller
{
    public function user()
    {
        $tableUser = User::get();
        return view('admins/panel', ['tableUser' => $tableUser]);
    }
    public function userAdd(AdminAddRequest $request)
    {
        if (empty($request['password'])) $request['password'] = bin2hex(random_bytes(5));

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'] ?? '',
            'github' => $request['github'] ?? '',
            'city' => $request['city'] ?? '',
            'phone' => $request['phone'] ?? '',
            'birthday' => $request['birthday'] ?? null,
            'post_id' => $request['post_id'] ?? 1,
            'role' => $request['role'] ?? 'user',
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->back();
    }
    public function userAddView()
    {
        return view('admins/add');
    }

    public function userEditView($id)
    {
        $infoUserId = User::where('id', '=', $id)->get(); //find запрос выводит всех пользователей
        if ($infoUserId == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        return view('admins/edit', ['infoUserId' => $infoUserId]);
    }

    public function userEdit(AdminEditRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        $idUser = $request['id'];
        $infoUser = User::find($idUser);
        if ($infoUser == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);
        $infoUser->update($request->all());
        return redirect()->back();
    }

    public function userDelete($id)
    {
        if ($id == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        User::find($id)->delete();
        return redirect()->route('users');
    }
}
