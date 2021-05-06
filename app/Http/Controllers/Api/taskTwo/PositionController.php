<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Models\Position;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    //--------------------------------------------------- Должность -------------------------------------------------------

    public function post()
    {
        $tablePost = Position::get();
        return view('Post', ['tablePost' => $tablePost]);
    }

    public function postAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions|max:255',
            'department_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            return view('PostAdd', ['error' => "Ошибка ввода данных"]);
        }

        if (empty($request['department_id'])) $request['department_id'] = 1;

        Position::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'],
        ]);

        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }
    public function postAddView()
    {
        return view('PostAdd');
    }

    public function postEditView($id)
    {
        $infoPostId = Position::find($id)->get();
        if ($infoPostId == null) 
                return view('error', ['error' => 'Такой пользоваль не найден']);

        return view('PostEdit', ['infoPostId' => $infoPostId]);
    }

    public function postEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255',
            'department_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            $infoPostId = Position::find($request['id'])->get();
            if ($infoPostId == null) 
                return view('error', ['error' => 'Такой пользоваль не найден']);

            return view('PostEdit', ['error' => "Ошибка ввода данных", 'infoPostId' => $infoPostId]);
        }

        $idUser = $request['id'];
        $infoUser = Position::find($idUser);
        if ($infoUser == null) 
            return view('error', ['error' => 'Такой пользоваль не найден']);

        $infoUser->update($request->all());
        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }

    public function postDelete($id)
    {
        if ($id == null) 
            return view('error', ['error' => 'Такой пользоваль не найден']);

        Position::find($id)->delete();
        return redirect()->action('Api\TaskTwo\AdminPanelController@post');
    }
}

