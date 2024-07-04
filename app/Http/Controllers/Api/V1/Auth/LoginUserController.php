<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginUserController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = [
                'email' => $request['email'],
                'password' => $request['password'],
            ];
            if(!$token = auth()->attempt($credentials)){
                return response()->json([
                    "status"    => 0,
                    "message"   => "Invalid credentials"
                ], 401);
            }else{
                return response()->json([
                    "status"    => 0,
                    "message"   => "Logged in successfully",
                    "token"     => $token,
                ], 200);
            }

        }catch (Exception $e){
            return response()->json([
                "status"    => 0,
                "message"   => $e->getMessage()
            ], 500);
        }
    }
}
