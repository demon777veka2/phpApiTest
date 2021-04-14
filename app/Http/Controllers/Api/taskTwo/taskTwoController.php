<?php

namespace App\Http\Controllers\Api\taskTwo;

use Illuminate\Http\Request;
use App\Models\taskTwo;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class taskTwoController extends Controller
{
    public function table()
    {

        $e = new UserNotDefinedException;
        try {
            if (JWTAuth::parseToken()->authenticate() != null) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 404);
            }
        } catch (UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        return response()->json(taskTwo::get(), 200);
    }

    public function tableid($id)
    {
        $taskTwo = taskTwo::find($id);
        if (is_null($taskTwo)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404);
        }
        return response()->json($taskTwo, 200);
    }

    public function tableSave(Request $request)
    {
        $rules = [
            'alias' => 'required|min:2|max:10',
            'name' => 'required|min:2|max:10',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $country = taskTwo::create($request->all());
        return response()->json($country, 201);
    }


    public function tableEdit(Request $request, $id)
    {
        $rules = [
            'alias' => 'required|min:2|max:10',
            'name' => 'required|min:2|max:10',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $taskTwo = taskTwo::find($id);
        if (is_null($taskTwo)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404);
        }
        $taskTwo->update($request->all());
        return response()->json($taskTwo, 200);
    }


    public function tableDelete(Request $request, $id)
    {
        $taskTwo = taskTwo::find($id);
        if (is_null($taskTwo)) {
            return response()->json(['error' => true, 'message' => 'Not Found'], 404);
        }
        $taskTwo->delete();
        return response()->json('', 200);
    }
}
