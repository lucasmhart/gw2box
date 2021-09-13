<?php

namespace App\Http\Controllers;

use App\Src\GWObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $gwObject = (new GWObject(Auth::user()))->getObjectJson();

        return view('account.index', compact(['gwObject']));
    }
}
