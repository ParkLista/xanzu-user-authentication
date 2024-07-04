<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            if(auth()->user()){
                return response()->json([
                    'success' => true,
                    'data' => auth()->user()
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'data' => 'Unauthorized'
                ], 401);
            }
        }catch (\Exception $exception){
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }

    public function updateProfile(Request $request): \Illuminate\Http\JsonResponse
    {
        try{
            if(auth()->user()){
                $user = User::find(auth()->user()->id);
                $user->firstname = !empty($request->firstname)? strtolower($request->firstname): $user->firstname;
                $user->lastname = !empty($request->lastname)? strtolower($request->lastname): $user->lastname;
                $user->telephone = !empty($request->telephone)? $request->telephone: $user->telephone;
                $user->birth_date = !empty($request->birth_date)? $request->birth_date: $user->birth_date;
                $user->gender = !empty($request->gender)? $request->gender: $user->gender;
                if($user->save()){
                    return response()->json([
                        'success' => true,
                        'data' => $user,
                        'message' => 'Profile updated successfully.'
                    ], 200);
                }else{
                    return response()->json([
                        'success' => false,
                        'data' => 'Something went wrong.'
                    ], 400 );
                }
            }
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
