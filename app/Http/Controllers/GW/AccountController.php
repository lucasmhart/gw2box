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

    public function dailycrafting()
    {
        GWAccount::updateDailycrafting(Auth::user());

        return $this->getObjectResponse();
    }

    public function dungeons()
    {
        GWAccount::updateDungeons(Auth::user());

        return $this->getObjectResponse();
    }

    public function dyes()
    {
        GWAccount::updateDyes(Auth::user());

        return $this->getObjectResponse();
    }

    public function emotes()
    {
        GWAccount::updateEmotes(Auth::user());

        return $this->getObjectResponse();
    }

    public function finishers()
    {
        GWAccount::updateFinishers(Auth::user());

        return $this->getObjectResponse();
    }

    public function gliders()
    {
        GWAccount::updateGliders(Auth::user());

        return $this->getObjectResponse();
    }

    public function homeNodes()
    {
        GWAccount::updateHomeNodes(Auth::user());

        return $this->getObjectResponse();
    }

    private function getObjectResponse()
    {
        $gwObject = (new GWObject(Auth::user()))->getObjectJson();
        return response()->json(['object' => $gwObject], 200);
    }
}
