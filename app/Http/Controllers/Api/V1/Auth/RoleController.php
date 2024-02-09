<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $role = $request->validated();
        $role->name = $request->role;
        $role->desc = $request->desc;
        return response()->json([], 201);
    }
}
