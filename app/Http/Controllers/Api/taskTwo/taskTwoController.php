<?php

namespace App\Http\Controllers\Api\TaskTwo;

use App\Http\Requests\AdminEditRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\User;
use App\Models\Position;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskTwoController extends Controller
{
    public function department()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'user not found'], 404);
        }
        $idUser = JWTAuth::parseToken()->authenticate()->id;
        $postId =  User::find($idUser)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        $otdelId =  Position::find($postId)->get('department_id');
        $otdelId = preg_replace("/[^0-9]/", '', $otdelId);

        if ($postId == 1) {
            $otdelInfo = Department::where('name', '!=', 'admin')->where('name', '!=', 'user')->get();
            return response()->json($otdelInfo, 200);
        }

        $myDepartmentInfo = Position::where('department_id', '=', $otdelId)->get();
        $otdelInfo = Department::where('name', '!=', 'admin')->where('name', '!=', 'user')->get();

        return response()->json([$myDepartmentInfo, $otdelInfo], 200);
    }

    public function user()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' =>'user not found'], 404);
        }

        $idUser = JWTAuth::parseToken()->authenticate()->id;

        $info = User::find($idUser)->get();
        if (is_null($info)) {
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($info, 200);
    }

    public function userPut(AdminEditRequest $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' =>'user not found'], 404);
        }

        $idUser = JWTAuth::parseToken()->authenticate()->id;
        $infoUser = User::find($idUser);

        $infoUser->update($request->all());

        return response()->json($infoUser, 200);
    }

    public function workersAll(Request $request)
    {
        //При передаче параметра query
        if (!empty($request['query'])) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user not found'], 404);
            }

            //Проверка, является ли этот пользователь работником
            $userId = JWTAuth::parseToken()->authenticate()->id;
            $postId = User::find($userId)->get('post_id');
            $postId = preg_replace("/[^0-9]/", '', $postId);

            if ($postId == "1") {
                return response()->json(['error' => 'Нет права доступа'], 403);
            }

            $name = $request['query'];

            //получения доступа к его данным, сверяя с его должностью
            $bdcheck = User::where('name', '=', $name)->count() > 0;
            if ($bdcheck == null)
                return response()->json(['error' => 'Not found name'], 404);

            $userIdSerchDepartment = User::where('name', '=', $name)->get('post_id');
            $userIdSerchDepartment = preg_replace("/[^0-9]/", '', $userIdSerchDepartment);

            $userDepartmentId = Position::where('department_id', '=', $userIdSerchDepartment)->get('department_id');
            $userDepartmentId = preg_replace("/[^0-9]/", '', $userDepartmentId);


            $myDepartmentId = Position::find($postId)->get('department_id');
            $myDepartmentId = preg_replace("/[^0-9]/", '', $myDepartmentId);

            if ($userDepartmentId ==  $myDepartmentId) {
                $UserInfo = User::where('name', '=', $name)->get();
                return response()->json($UserInfo, 200);
            }
            return response()->json(['error' => 'Нет права доступа'], 403);
        }

        //При передаче параметра department_id
        if (!empty($request['department_id'])) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user not found'], 404);
            }

            //Проверка, является ли этот пользователь работником
            $userId = JWTAuth::parseToken()->authenticate()->id;
            $postId = User::find($userId)->get('post_id');
            $postId = preg_replace("/[^0-9]/", '', $postId);

            if ($postId == "1") {
                return response()->json(['error' => 'Нет права доступа'], 403);
            }

            $id = $request['department_id'];

            //получения доступа к его данным, сверяя с его должностью
            $bdcheck = Department::find($id)->count() > 0;
            if ($bdcheck == null)
                return response()->json(['error' => 'Not found otdel'], 404);

            $myDepartmentId = Position::find($postId)->get('department_id');
            $myDepartmentId = preg_replace("/[^0-9]/", '', $myDepartmentId);

            if ($id ==  $myDepartmentId) {

                //Вывод информации пользователей с одного отдела
                $arrayId = array(); //пустой массив для будущих id post

                $ammountPost = Position::get()->count();
                for ($i = 1; $i <= $ammountPost; $i++) {

                    $indexDepartmentId = Position::find($i)->get('department_id');
                    $indexDepartmentId = preg_replace("/[^0-9]/", '', $indexDepartmentId);

                    if ($myDepartmentId == $indexDepartmentId) {
                        $arrayId[] = $i;
                    }
                }

                $tableDepartment = array();
                $ammountUser = User::count();
                for ($i = 1; $i <= $ammountUser; $i++) {
                    $indexUserId = User::find($i)->get('post_id');
                    $indexUserId = preg_replace("/[^0-9]/", '', $indexUserId);

                    foreach ($arrayId as $value) {

                        if ($indexUserId == $value) {
                                $tableDepartment[] = User::find('id', '=', $i)->get();
                        }
                    }
                }
                return response()->json($tableDepartment, 200);
            }
            return response()->json(['error' => 'Нет права доступа'], 403);
        }

        //При передаче параметра position_id 
        if (!empty($request['position_id'])) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user not found'], 404);
            }

            //Проверка, является ли этот пользователь работником
            $userId = JWTAuth::parseToken()->authenticate()->id;
            $postId = User::find($userId)->get('post_id');
            $postId = preg_replace("/[^0-9]/", '', $postId);

            if ($postId == "1") {
                return response()->json(['error' => 'Нет права доступа'], 403);
            }

            $id = $request['position_id'];

            //получения доступа к данным, сверяя с отделом
            $bdcheck = Position::find($id)->count() > 0;
            if ($bdcheck == null)
                return response()->json(['error' =>'Not found id post'], 404);

            $requestedPostlId = Position::find($id)->get('department_id');
            $requestedPostlId = preg_replace("/[^0-9]/", '', $requestedPostlId);

            $myDepartmentId = Position::find($postId)->get('department_id');
            $myDepartmentId = preg_replace("/[^0-9]/", '', $myDepartmentId);

            if ($requestedPostlId ==  $myDepartmentId) {
                $UserInfo = User::where('post_id', '=', $id)->get();
                return response()->json($UserInfo, 200);
            }
            return response()->json(['error' => 'Нет права доступа'], 403);
        }

        return response()->json(['error' =>  'Такого параметра нет'], 404);
    }

    public function workersSerchIdUser($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'user not found'], 404);
        }

        //Проверка, является ли этот пользователь работником
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $postId = User::find($userId)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        if ($postId == "1") {
            return response()->json(['error' => 'Нет права доступа'], 403);
        }

        //получения доступа к данным, сверяя с отделом
        $bdcheck = User::find($id)->count() > 0;
        if ($bdcheck == null)
            return response()->json(['error' =>  'Not found id'], 404);

        $userIdSerchDepartment = User::find($id)->get('post_id');
        $userIdSerchDepartment = preg_replace("/[^0-9]/", '', $userIdSerchDepartment);

        $userDepartmentId = Position::where('department_id', '=', $userIdSerchDepartment)->get('department_id');
        $userDepartmentId = preg_replace("/[^0-9]/", '', $userDepartmentId);

        $myDepartmentId = Position::find($postId)->get('department_id');
        $myDepartmentId = preg_replace("/[^0-9]/", '', $myDepartmentId);

        if ($userDepartmentId ==  $myDepartmentId) {
            $UserInfo = User::find($id)->get();
            return response()->json($UserInfo, 200);
        }
        return response()->json(['error' => 'Нет права доступа'], 403);
    }
}
