<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
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
    public function userAdd(Request $request)
    {
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
            return view('AdminPanelAdd', ['error' => "Ошибка ввода данных"]);
        }


        if (empty($request['type'])) $request['type'] = '';
        if (empty($request['github'])) $request['github'] = '';
        if (empty($request['city'])) $request['city'] = '';
        if (empty($request['phone'])) $request['phone'] = '';
        if (empty($request['birthday'])) $request['birthday'] = null;
        if (empty($request['post_id'])) $request['post_id'] = 1;
        if (empty($request['password'])) $request['password'] = bin2hex(random_bytes(5));


        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'github' => $request['github'],
            'city' => $request['city'],
            'phone' => $request['phone'],
            'birthday' => $request['birthday'],
            'post_id' => $request['post_id'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->action('Api\TaskTwo\AdminPanelController@user');
    }
    public function userAddView()
    {
        return view('AdminPanelAdd');
    }

    public function userEditView($id)
    {
        $infoUserId = User::find($id)->get();
        if ($infoUserId == null) 
            return view('error', ['error' => 'Такой пользоваль не найден']);

        return view('AdminPanelEdit', ['infoUserId' => $infoUserId]);
    }

    public function userEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'type' => 'nullable',
            'github' => 'nullable|regex:/github.com([\/A-z]*)/',
            'city' => 'nullable',
            'phone' => 'max:11|nullable|regex:/8[0-9]{10}/',
            'birthday' => 'regex:/[0-9]{4}/|max:4|nullable',
            'post_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            $infoUserId = User::find($request['id'])->get();
            if ($infoUserId == null) 
                return view('error', ['error' => 'Такой пользоваль не найден']);

            return view('AdminPanelEdit', ['error' => "Ошибка ввода данных", 'infoUserId' => $infoUserId]);
        }

        $idUser = $request['id'];
        $infoUser = User::find($idUser);
        if ($infoUser == null) 
            return view('error', ['error' => 'Такой пользоваль не найден']);

        $infoUser->update($request->all());
        return redirect()->action('Api\TaskTwo\AdminPanelController@user');
    }

    public function userDelete($id)
    {
        if ($id == null) 
                return view('error', ['error' => 'Такой пользоваль не найден']);

        User::find($id)->delete();
        return redirect()->action('Api\TaskTwo\AdminPanelController@user');
    }
}