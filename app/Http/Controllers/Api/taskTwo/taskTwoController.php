<?php

namespace App\Http\Controllers\Api\TaskTwo;

use Illuminate\Http\Request;
use App\User;
use App\Otdel;
use App\Post;
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
            return response()->json(['user_not_found'], 404);
        }
        $idUser = JWTAuth::parseToken()->authenticate()->id;
        $postId =  User::where('id', '=', $idUser)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        $otdelId =  Post::where('id', '=', $postId)->get('otdel_id');
        $otdelId = preg_replace("/[^0-9]/", '', $otdelId);

        if ($postId == 1) {
            $otdelInfo = Otdel::where('name', '!=', 'admin')->where('name', '!=', 'user')->get();
            return response()->json($otdelInfo, 200);
        }

        $myOtdelInfo = Post::where('otdel_id', '=', $otdelId)->get();
        $otdelInfo = Otdel::where('name', '!=', 'admin')->where('name', '!=', 'user')->get();

        return response()->json([$myOtdelInfo, $otdelInfo], 200);
    }

    public function user()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $idUser = JWTAuth::parseToken()->authenticate()->id;

        $info = User::where('id', '=', $idUser)->get();
        if (is_null($info)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404);
        }
        return response()->json($info, 200);
    }

    public function userPut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|unique:users|max:255',
            'email' => 'nullable|email|unique:users|max:255',
            'type' => 'nullable',
            'github' => 'nullable|regex:/github.com([\/A-z]*)/',
            'city' => 'nullable',
            'phone' => 'max:11|nullable|regex:/8[0-9]{10}/',
            'birthday' => 'regex:/[0-9]{4}/|max:4|nullable',
            'post_id' => 'regex:/[0-9]*/|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => true, 'massage' => 'Ошибка ввода данных']);
        }

        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        $idUser = JWTAuth::parseToken()->authenticate()->id;
        $infoUser = User::find($idUser);

        $infoUser->update($request->all());

        return response()->json($infoUser, 200);
    }

    public function workersAll(Request $request)
    {
        if (!empty($request['query']))
            return redirect()->action('Api\TaskTwo\TaskTwoController@workersSerchName', ['query' => $request['query']]);

           

            
    }

    public function workersSerchName($query)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        //Проверка, является ли этот пользователь работником
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $postId = User::where('id', '=', $userId)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        if ($postId == "1") {
            return response()->json(['error' => true, 'message' => 'Нет права доступа']);
        }

        //получения доступа к его данным, сверяя с его должностью
        $bdcheck = User::where('name', '=', $query)->get()->count() > 0;
        if ($bdcheck == null)
            return response()->json(['error' => true, 'message' => 'Not found name']);

        $userIdSerchOtdel = User::where('name', '=', $query)->get('post_id');
        $userIdSerchOtdel = preg_replace("/[^0-9]/", '', $userIdSerchOtdel);

        $userOtdelId = Post::where('otdel_id', '=', $userIdSerchOtdel)->get('otdel_id');
        $userOtdelId = preg_replace("/[^0-9]/", '', $userOtdelId);


        $myOtdelId = Post::where('id', '=', $postId)->get('otdel_id');
        $myOtdelId = preg_replace("/[^0-9]/", '', $myOtdelId);

        if ($userOtdelId ==  $myOtdelId) {
            $UserInfo = User::where('name', '=', $query)->get();
            return response()->json($UserInfo, 200);
        }
        return response()->json(['error' => true, 'message' => 'Нет права доступа']);
    }

    public function workersSerchIdOtdel($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        //Проверка, является ли этот пользователь работником
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $postId = User::where('id', '=', $userId)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        if ($postId == "1") {
            return response()->json(['error' => true, 'message' => 'Нет права доступа']);
        }

        //получения доступа к его данным, сверяя с его должностью
        $bdcheck = Otdel::where('id', '=', $id)->get()->count() > 0;
        if ($bdcheck == null)
            return response()->json(['error' => true, 'message' => 'Not found otdel']);

        $myOtdelId = Post::where('id', '=', $postId)->get('otdel_id');
        $myOtdelId = preg_replace("/[^0-9]/", '', $myOtdelId);

        if ($id ==  $myOtdelId) {

            //Вывод информации пользователей с одного отдела
            $arrayId = array(); //пустой массив для будущих id post

            $ammountPost = Post::get()->count();
            for ($i = 1; $i <= $ammountPost; $i++) {

                $indexOtdelId = Post::where('id', '=', $i)->get('otdel_id');
                $indexOtdelId = preg_replace("/[^0-9]/", '', $indexOtdelId);

                if ($myOtdelId == $indexOtdelId) {
                    $arrayId[] = $i;
                }
            }

            $tableOtdel = array();
            $ammountUser = User::get()->count();
            for ($i = 1; $i <= $ammountUser; $i++) {
                $indexUserId = User::where('id', '=', $i)->get('post_id');
                $indexUserId = preg_replace("/[^0-9]/", '', $indexUserId);

                foreach ($arrayId as $value) {

                    if ($indexUserId == $value) {
                        if ($i == 1) {
                            $tableOtdel[] = User::where('id', '=', $i)->get();
                        } else {
                            $tableOtdel[] =  User::where('id', '=', $i)->get(); //Обьединение записей в 1 таблицу  
                        }
                    }
                }
            }
            return response()->json($tableOtdel, 200);
        }
        return response()->json(['error' => true, 'message' => 'Нет права доступа']);
    }

    public function workersSerchIdPost($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        //Проверка, является ли этот пользователь работником
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $postId = User::where('id', '=', $userId)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        if ($postId == "1") {
            return response()->json(['error' => true, 'message' => 'Нет права доступа']);
        }

        //получения доступа к данным, сверяя с отделом
        $bdcheck = Post::where('id', '=', $id)->get()->count() > 0;
        if ($bdcheck == null)
            return response()->json(['error' => true, 'message' => 'Not found id post']);

        $requestedPostlId = Post::where('id', '=', $id)->get('otdel_id');
        $requestedPostlId = preg_replace("/[^0-9]/", '', $requestedPostlId);

        $myOtdelId = Post::where('id', '=', $postId)->get('otdel_id');
        $myOtdelId = preg_replace("/[^0-9]/", '', $myOtdelId);

        if ($requestedPostlId ==  $myOtdelId) {
            $UserInfo = User::where('post_id', '=', $id)->get();
            return response()->json($UserInfo, 200);
        }
        return response()->json(['error' => true, 'message' => 'Нет права доступа1']);
    }


    public function workersSerchIdUser($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        //Проверка, является ли этот пользователь работником
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $postId = User::where('id', '=', $userId)->get('post_id');
        $postId = preg_replace("/[^0-9]/", '', $postId);

        if ($postId == "1") {
            return response()->json(['error' => true, 'message' => 'Нет права доступа']);
        }

        //получения доступа к данным, сверяя с отделом
        $bdcheck = User::where('id', '=', $id)->get()->count() > 0;
        if ($bdcheck == null)
            return response()->json(['error' => true, 'message' => 'Not found id']);

        $userIdSerchOtdel = User::where('id', '=', $id)->get('post_id');
        $userIdSerchOtdel = preg_replace("/[^0-9]/", '', $userIdSerchOtdel);

        $userOtdelId = Post::where('otdel_id', '=', $userIdSerchOtdel)->get('otdel_id');
        $userOtdelId = preg_replace("/[^0-9]/", '', $userOtdelId);

        $myOtdelId = Post::where('id', '=', $postId)->get('otdel_id');
        $myOtdelId = preg_replace("/[^0-9]/", '', $myOtdelId);

        if ($userOtdelId ==  $myOtdelId) {
            $UserInfo = User::where('id', '=', $id)->get();
            return response()->json($UserInfo, 200);
        }
        return response()->json(['error' => true, 'message' => 'Нет права доступа']);
    }
}
