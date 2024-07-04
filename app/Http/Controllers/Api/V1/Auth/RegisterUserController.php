<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function create(RegistrationRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $newUser = $request->validated();
            $newUser['firstname'] = strtolower($newUser['firstname']);
            $newUser['lastname'] = strtolower($newUser['lastname']);
            $newUser['email'] = strtolower($newUser['email']);
            $newUser['username'] = strtolower($newUser['username']);
            $newUser['password'] = bcrypt($newUser['password']);
            $user = User::create($newUser);
            return response()->json([
                "status"    => 201,
                "data"      => $user,
            ], 201);
        }catch(Exception $e){
            return response()->json([
                "status"    => 0,
                "message"   => $e->getMessage()
            ], 500);
        }
    }
}
