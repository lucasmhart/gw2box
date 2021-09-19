<?php

namespace App\Src\GW\Helpers;

use App\Models\GWAccount;
use App\Models\GWAccount_achievement;
use App\Models\User;
use Carbon\Carbon;
use stdClass;

class GWObject
{
    private $user;
    private $object;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->object = new stdClass();
        $this->setObject();
    }

    public function getObject()
    {
        return $this->object;
    }

    public function getObjectJson()
    {
        return json_encode($this->getObject());
    }

    private function setObject()
    {
        $this->object->key = $this->setKeyData();
        $this->object->account = $this->setAccountData();
    }

    private function setKeyData()
    {
        $key = new stdClass();
        $key->key = $this->user->api_key;
        $key->is_valid = $this->user->is_api_key_valid;
        return $key;
    }

    private function setAccountData()
    {
        $account = GWAccount::where('user_id', $this->user->id)->first();

        if ($account) {
            $account->access = $account->access ?? new stdClass();
            $account->guilds = $account->guilds ?? new stdClass();
            $account->is_updatable = $this->isUpdatable($account->updates, 'account');
            $account->achievs = [
                'items' => $this->getAccountAchievements($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'achievements')
            ];
        }

        return $account;
    }

    private function getAccountAchievements($account)
    {
        $response = [];
        $achievements = GWAccount_achievement::where('gw_account_id', $account->id)->get();

        foreach ($achievements as $achievement) {
            $item = $achievement;
            $item->bits = explode(',', $item->bits);
            $response[] = $item;
        }

        return $response;
    }

    public function getApiKey()
    {
        return $this->object->key->key;
    }

    private function isUpdatable($object, $field)
    {
        if (!isset($object->$field)) {
            return true;
        }

        return $object->$field->diffInMinutes(Carbon::now()) > 60;
    }
}
