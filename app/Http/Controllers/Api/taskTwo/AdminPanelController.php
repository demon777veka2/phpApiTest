<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Otdel;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Http\Response;
use App\Http\Requests;



class AdminPanelController extends Controller
{
    public function user()
    {
        $tableUser = User::get();
        return view('AdminPanel', ['tableUser' => $tableUser]);
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
        $infoUserId = User::where('id', $id)->get();
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
            $infoUserId = User::where('id', $request['id'])->get();
            return view('AdminPanelEdit', ['error' => "Ошибка ввода данных", 'infoUserId' => $infoUserId]);
        }

        $idUser = $request['id'];
        $infoUser = User::find($idUser);

        $infoUser->update($request->all());
        return redirect()->action('Api\TaskTwo\AdminPanelController@user');
    }

    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->action('Api\TaskTwo\AdminPanelController@user');
    }

    //--------------------------------------------------- Отдел -------------------------------------------------------

    public function otdel()
    {
        $tableOtdel = Otdel::get();
        return view('Otdel', ['tableOtdel' => $tableOtdel]);
    }

    public function otdelAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:posts|max:255',
        ]);

        if ($validator->fails()) {
            return view('OtdelAdd', ['error' => "Ошибка ввода данных"]);
        }


        Otdel::create([
            'name' => $request['name']
        ]);

        return redirect()->action('Api\TaskTwo\AdminPanelController@otdel');
    }
    public function otdelAddView()
    {
        return view('OtdelAdd');
    }

    public function otdelEditView($id)
    {
        $infoOtdelId = Otdel::where('id', $id)->get();
        return view('OtdelEdit', ['infoUserId' => $infoOtdelId]);
    }

    public function otdelEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:posts|max:255',
        ]);

        if ($validator->fails()) {
            $infoOtdelId = Otdel::where('id', $request['id'])->get();
            return view('OtdelEdit', ['error' => "Ошибка ввода данных", 'infoUserId' => $infoOtdelId]);
        }

        $idUser = $request['id'];
        $infoUser = Otdel::find($idUser);

        $infoUser->update($request->all());
        return redirect()->action('Api\TaskTwo\AdminPanelController@otdel');
    }

    public function otdelDelete($id)
    {
        Otdel::where('id', $id)->delete();
        return redirect()->action('Api\TaskTwo\AdminPanelController@otdel');
    }

    //--------------------------------------------------- Должность -------------------------------------------------------

    public function post()
    {
        $tablePost = Post::get();
        return view('Post', ['tablePost' => $tablePost]);
    }

    public function postAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:posts|max:255',
            'otdel_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            return view('PostAdd', ['error' => "Ошибка ввода данных"]);
        }

        if (empty($request['otdel_id'])) $request['otdel_id'] = 1;

        Post::create([
            'name' => $request['name'],
            'otdel_id' => $request['otdel_id'],
        ]);

        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }
    public function postAddView()
    {
        return view('PostAdd');
    }

    public function postEditView($id)
    {
        $infoPostId = Post::where('id', $id)->get();
        return view('PostEdit', ['infoPostId' => $infoPostId]);
    }

    public function postEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255',
            'otdel_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            $infoPostId = Post::where('id', $request['id'])->get();
            return view('PostEdit', ['error' => "Ошибка ввода данных", 'infoPostId' => $infoPostId]);
        }

        $idUser = $request['id'];
        $infoUser = Post::find($idUser);

        $infoUser->update($request->all());
        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }

    public function postDelete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }
}
