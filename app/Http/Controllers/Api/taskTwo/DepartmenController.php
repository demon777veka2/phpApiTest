<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmenController extends Controller
{
    public function department()
    {
        $tableDepartment = Department::get();
        return view('departments/main', ['tableDepartment' => $tableDepartment]);
    }

    public function departmentAdd(DepartmentRequest $request)
    {
        Department::create([
            'name' => $request['name']
        ]);

        return redirect()->back();
    }
    public function departmentAddView()
    {
        return view('departments/add');
    }

    public function departmentEditView($id)
    {
        $infoDepartmentId = Department::where('id', '=', $id)->get(); //Find выводит все Department
        if ($infoDepartmentId == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        return view('departments/edit', ['infoDepartmentId' => $infoDepartmentId]);
    }

    public function departmentEdit(DepartmentRequest $request)
    {
        $idUser = $request['id'];
        $infoUser = Department::find($idUser);

        $infoUser->update($request->all());
        return redirect()->back();
    }

    public function departmentDelete($id)
    {
        if ($id == null)
            return view('error', ['error' => 'Такой пользоваль не найден']);

        Department::find($id)->delete();
        return redirect()->route('departments');
    }
}
