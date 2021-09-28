<?php

namespace App\Src\GW\Helpers;

use App\Models\GWAccount;
use App\Models\GWAccount_achievement;
use App\Models\GWAccount_bank;
use App\Models\GWAccount_dailycrafting;
use App\Models\GWAccount_dungeon;
use App\Models\GWAccount_dyes;
use App\Models\GWAccount_emotes;
use App\Models\GWAccount_finishers;
use App\Models\GWAccount_gliders;
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
            $account->bank = [
                'items' => $this->getAccountBank($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'bank')
            ];
            $account->dailycrafting = [
                'items' => $this->getAccountDailycrafting($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'dailycrafting')
            ];
            $account->dungeons = [
                'items' => $this->getAccountDungeons($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'dungeons')
            ];
            $account->dyes = [
                'items' => $this->getAccountDyes($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'dyes')
            ];
            $account->emotes = [
                'items' => $this->getAccountEmotes($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'emotes')
            ];
            $account->finishers = [
                'items' => $this->getAccountFinishers($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'finishers')
            ];
            $account->gliders = [
                'items' => $this->getAccountGliders($account),
                'is_updatable' => $this->isUpdatable($account->updates, 'gliders')
            ];
        }

        return $account;
    }

    private function getAccountBank($account)
    {
        $response = [];
        $bank_items = GWAccount_bank::where('gw_account_id', $account->id)->get();

        foreach ($bank_items as $bank_item) {
            $item = $bank_item;
            $item->dyes = json_decode($bank_item->dyes);
            $item->upgrades = json_decode($bank_item->upgrades);
            $item->upgrade_slot_indices = json_decode($bank_item->upgrade_slot_indices);
            $item->infusions = json_decode($bank_item->infusions);
            $item->stats = json_decode($bank_item->stats);

            $response[] = $item;
        }

        return $response;
    }

    private function getAccountAchievements($account)
    {
        $response = [];
        $achievements = GWAccount_achievement::where('gw_account_id', $account->id)->get();

        foreach ($achievements as $achievement) {
            $item = $achievement;
            $item->bits = json_decode($item->bits);
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

    private function getAccountDailycrafting($account)
    {
        $dailyCraftings = GWAccount_dailycrafting::where('gw_account_id', $account->id)->first();
        if (!$dailyCraftings) {
            return [];
        }
        return json_decode($dailyCraftings->items);
    }

    private function getAccountDungeons($account)
    {
        $dungeons = GWAccount_dungeon::where('gw_account_id', $account->id)->first();
        if (!$dungeons) {
            return [];
        }
        return json_decode($dungeons->dungeons);
    }

    private function getAccountDyes($account)
    {
        $dyes = GWAccount_dyes::where('gw_account_id', $account->id)->first();
        if (!$dyes) {
            return [];
        }
        return json_decode($dyes->dyes);
    }

    private function getAccountEmotes($account)
    {
        $emotes = GWAccount_emotes::where('gw_account_id', $account->id)->first();
        if (!$emotes) {
            return [];
        }
        return json_decode($emotes->emotes);
    }

    private function getAccountFinishers($account)
    {
        $finishers = GWAccount_finishers::where('gw_account_id', $account->id)->first();
        if (!$finishers) {
            return [];
        }
        return json_decode($finishers->finishers);
    }

    private function getAccountGliders($account)
    {
        $gliders = GWAccount_gliders::where('gw_account_id', $account->id)->first();
        if (!$gliders) {
            return [];
        }
        return json_decode($gliders->gliders);
    }
}
