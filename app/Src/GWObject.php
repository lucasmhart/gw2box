<?php

namespace App\Src;

use App\Models\User;
use stdClass;

class GWObject
{
    private User $user;
    private stdClass $object;

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
        $this->object->key = $this->getKeyData();
        $this->object->account = $this->getAccountData();
    }

    private function getKeyData()
    {
        $key = new stdClass();
        $key->key = $this->user->api_key;
        $key->is_valid = $this->user->is_api_key_valid;
        return $key;
    }

    private function getAccountData()
    {
        $account = $this->user->account;
        if ($account) {
            $account->access = $account->access ?? new stdClass();
            $account->guilds = $account->guilds ?? new stdClass();
        }

        return $account;
    }
}
