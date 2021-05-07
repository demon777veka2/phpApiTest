<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function post()
    {
        $tablePost = Position::get();
        return view('posts/main', ['tablePost' => $tablePost]);
    }

    public function postAdd(Request $request)
    {
        Position::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'] ?? 1,
        ]);

        return redirect()->route('positions');
    }
    public function postAddView()
    {
        return view('posts/add');
    }

    public function postEditView($id)
    {
        $infoPostId = Position::where('id','=',$id)->get();
        if ($infoPostId == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        return view('posts/edit', ['infoPostId' => $infoPostId]);
    }

    public function postEdit(Request $request)
    {
        $idUser = $request['id'];
        $infoUser = Position::find($idUser);
        if ($infoUser == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        $infoUser->update($request->all());
        return redirect()->back();
    }

    public function postDelete($id)
    {
        if ($id == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        Position::find($id)->delete();
        return redirect()->route('positions');
    }
}
