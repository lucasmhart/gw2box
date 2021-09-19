<?php

namespace App\Http\Controllers;

use App\Src\GW\Helpers\GWObject;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $gwObject = (new GWObject(Auth::user()))->getObjectJson();

        return view('account.index', compact(['gwObject']));
    }
}
