<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(UserCreateRequest $request)
    {
        dd($request->all());
    }
}
