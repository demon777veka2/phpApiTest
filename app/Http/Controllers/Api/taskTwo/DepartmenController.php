<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmenController extends Controller
{
     public function department()
     {
         $tableDepartment = Department::get();
         return view('Department', ['tableDepartment' => $tableDepartment]);
     }
 
     public function departmentAdd(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|unique:positions|max:255',
         ]);
 
         if ($validator->fails()) {
             return view('DepartmentAdd', ['error' => "Ошибка ввода данных"]);
         }
 
         Department::create([
             'name' => $request['name']
         ]);
 
         return redirect()->action('Api\TaskTwo\AdminPanelController@department');
     }
     public function departmentAddView()
     {
         return view('DepartmentAdd');
     }
 
     public function departmentEditView($id)
     {
         $infoDepartmentId = Department::find($id)->get();
         if ($infoDepartmentId == null) 
                 return view('error', ['error' => 'Такой пользоваль не найден']);
 
         return view('DepartmentEdit', ['infoUserId' => $infoDepartmentId]);
     }
 
     public function departmentEdit(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|unique:positions|max:255',
         ]);
 
         if ($validator->fails()) {
             $infoDepartmentId = Department::find($request['id'])->get();
             return view('DepartmentEdit', ['error' => "Ошибка ввода данных", 'infoUserId' => $infoDepartmentId]);
         }
 
         $idUser = $request['id'];
         $infoUser = Department::find($idUser);
 
         $infoUser->update($request->all());
         return redirect()->action('Api\TaskTwo\AdminPanelController@department');
     }
 
     public function departmentDelete($id)
     {
         if ($id == null) 
                 return view('error', ['error' => 'Такой пользоваль не найден']);
 
         Department::find($id)->delete();
         return redirect()->action('Api\TaskTwo\AdminPanelController@department');
     }
}
