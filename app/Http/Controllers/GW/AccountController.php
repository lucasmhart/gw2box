<?php

namespace App\Http\Controllers\GW;

use App\Http\Controllers\Controller;
use App\Src\GW\Helpers\GWObject;
use App\Src\GW\Updaters\GWAccount;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $gw_object;

    /**
     * TODO CRIAR:
     *  - LIDAR COM A POSSIBILIDADE DA CHAVE INVÁLIDA
     */
    public function account()
    {
        GWAccount::updateAccount(Auth::user());

        return $this->getObjectResponse();
    }

    public function achievements()
    {
        GWAccount::updateAchievements(Auth::user());

        return $this->getObjectResponse();
    }

    public function bank()
    {
        GWAccount::updateBank(Auth::user());

        return $this->getObjectResponse();
    }

    private function getObjectResponse()
    {
        $gwObject = (new GWObject(Auth::user()))->getObjectJson();
        return response()->json(['object' => $gwObject], 200);
    }
}
