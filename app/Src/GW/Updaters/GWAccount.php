<?php

namespace App\Src\GW\Updaters;

use App\Models\GWAccount as ModelsGWAccount;
use App\Models\GWAccount_access;
use App\Models\GWAccount_achievement;
use App\Models\GWAccount_bank;
use App\Models\GWAccount_dailycrafting;
use App\Models\GWAccount_dungeon;
use App\Models\GWAccount_dyes;
use App\Models\GWAccount_emotes;
use App\Models\GWAccount_finishers;
use App\Models\GWAccount_gliders;
use App\Models\GWAccount_guilds;
use App\Models\GWAccount_home_cats;
use App\Models\GWAccount_home_nodes;
use App\Models\GWAccount_inventory;
use App\Models\GWAccount_legendaryarmory;
use App\Src\GW\Helpers\GWObject;
use App\Src\GW\Helpers\GWRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class GWAccount
{
    private static $gw_object;

    public static function updateAccount($user)
    {
        $response = GWRequest::privateGet(self::getGWObject($user)->getApiKey(), self::getUrl('/'));

        $account = ModelsGWAccount::updateOrCreate(
            ['user_id' => $user->id],
            [
                'userid' => $user->id,
                'gw_id' => $response->id,
                'age' => $response->age,
                'name' => $response->name,
                'world' => $response->world,
                'created' => $response->created,
                'commander' => $response->commander,
                'fractal_level' => $response->fractal_level,
                'daily_ap' => $response->daily_ap,
                'monthly_ap' => $response->monthly_ap,
                'wvw_rank' => $response->wvw_rank,
                'last_modified' => $response->last_modified ?? '',
            ]
        );

        self::updateAccountGuilds($account, $response);
        self::updateAccountAccesses($account, $response);

        GWUpdaters::updateAccountUpdater($account->id, 'account');

        self::updateLuck($user);
    }

    public static function updateAchievements($user)
    {
        $response = self::get($user, '/achievements');
        $account_id = $user->account->id;

        $achievs = [];
        foreach ($response as $achiev) {
            $bits = null;
            if (isset($achiev->bits)) {
                $bits = json_encode($achiev->bits);
            }

            $achiev->gw_account_id = $account_id;
            $achiev->bits = $bits;
            $achiev->current = $achiev->current ?? null;
            $achiev->max = $achiev->max ?? null;
            $achiev->done = $achiev->done ?? null;
            $achiev->repeated = $achiev->repeated ?? null;
            $achiev->unlocked = $achiev->unlocked ?? null;

            $achievs[] = (array) $achiev;
        }


        GWAccount_achievement::upsert(
            $achievs,
            ['account_id', 'id'],
            ['bits', 'current', 'max', 'done', 'repeated', 'unlocked']
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'achievements');
    }

    public static function updateBank($user)
    {
        $response = self::get($user, '/bank');
        $account_id = $user->account->id;

        GWAccount_bank::where(['gw_account_id' => $account_id])->delete();

        foreach ($response as $item) {
            if (empty($item)) {
                GWAccount_bank::create(['gw_account_id' => $account_id]);
                continue;
            }

            $data = [
                'gw_account_id' => $account_id,
                'gw_id' => $item->id,
                'count' => $item->count,
            ];

            if (isset($item->charges)) {
                $data['charges'] = $item->charges;
            }

            if (isset($item->skin)) {
                $data['skin'] = $item->skin;
            }

            if (isset($item->bindings)) {
                $data['bindings'] = $item->bindings;
            }

            if (isset($item->binding_to)) {
                $data['binding_to'] = $item->binding_to;
            }

            if (isset($item->dyes)) {
                $data['dyes'] = json_encode($item->dyes);
            }

            if (isset($item->upgrades)) {
                $data['upgrades'] = json_encode($item->upgrades);
            }

            if (isset($item->upgrade_slot_indices)) {
                $data['upgrade_slot_indices'] = json_encode($item->upgrade_slot_indices);
            }

            if (isset($item->infusions)) {
                $data['infusions'] = json_encode($item->infusions);
            }

            if (isset($item->stats)) {
                $data['stats'] = json_encode($item->stats);
            }

            GWAccount_bank::create($data);
        }

        GWUpdaters::updateAccountUpdater($user->account->id, 'bank');
    }

    private static function updateAccountAccesses($account, $response)
    {
        GWAccount_access::where('gw_account_id', $account->id)->delete();

        foreach ($response->access as $access) {
            GWAccount_access::create([
                'gw_account_id' => $account->id,
                'access' => $access,
            ]);
        }
    }

    private static function updateAccountGuilds($account, $response)
    {
        GWAccount_guilds::where('gw_account_id', $account->id)->delete();

        foreach ($response->guilds as $guild) {
            $is_leader = false;

            foreach ($response->guild_leader as $guild_leader) {
                if ($guild === $guild_leader) {
                    $is_leader = true;
                }
            }

            GWAccount_guilds::create([
                'gw_account_id' => $account->id,
                'gw_guild_id' => $guild,
                'is_guild_leader' => $is_leader,
            ]);
        }
    }

    private static function getUrl($path)
    {
        return GWRequest::API_BASE_URL . "/account" . $path;
    }

    private static function getGWObject($user)
    {
        if (!self::$gw_object) {
            self::setGWObject($user);
        }

        return self::$gw_object;
    }

    private static function setGWObject($user)
    {
        self::$gw_object = new GWObject($user);
    }

    public static function updateDailycrafting($user)
    {
        GWAccount_dailycrafting::where('gw_account_id', $user->account->id)->delete();

        GWAccount_dailycrafting::create([
            'gw_account_id' => $user->account->id,
            'items' => json_encode(self::get($user, '/dailycrafting'))
        ]);
        GWUpdaters::updateAccountUpdater($user->account->id, 'dailycrafting');
    }

    public static function updateDungeons($user)
    {
        GWAccount_dungeon::where('gw_account_id', $user->account->id)->delete();

        GWAccount_dungeon::create([
            'gw_account_id' => $user->account->id,
            'dungeons' => json_encode(self::get($user, '/dungeons'))
        ]);
        GWUpdaters::updateAccountUpdater($user->account->id, 'dungeons');
    }

    public static function updateDyes($user)
    {
        GWAccount_dyes::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['dyes' => json_encode(self::get($user, '/dyes'))]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'dyes');
    }

    public static function updateEmotes($user)
    {
        $response = self::get($user, '/emotes');

        GWAccount_emotes::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['emotes' => json_encode($response)]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'emotes');
    }

    public static function updateFinishers($user)
    {
        $response = self::get($user, '/finishers');

        GWAccount_finishers::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['finishers' => json_encode($response)]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'finishers');
    }

    public static function updateGliders($user)
    {
        $response = self::get($user, '/gliders');

        GWAccount_gliders::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['gliders' => json_encode($response)]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'gliders');
    }

    public static function updateHomeNodes($user)
    {
        $response = self::get($user, '/home/nodes');

        GWAccount_home_nodes::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['nodes' => json_encode($response)]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'home_nodes');
    }

    public static function updateHomeCats($user)
    {
        $response = self::get($user, '/home/cats');

        GWAccount_home_cats::updateOrCreate(
            ['gw_account_id' => $user->account->id],
            ['cats' => json_encode($response)]
        );

        GWUpdaters::updateAccountUpdater($user->account->id, 'home_cats');
    }

    public static function updateInventory($user)
    {
        $response = self::get($user, '/inventory');
        GWAccount_inventory::where('gw_account_id', $user->account->id)->delete();

        foreach ($response as $item) {
            $data = ['gw_account_id' => $user->account->id];

            if (isset($item->id)) {
                $data['gw_id'] = $item->id;
            }
            if (isset($item->count)) {
                $data['count'] = $item->count;
            }
            if (isset($item->charges)) {
                $data['charges'] = $item->charges;
            }
            if (isset($item->skin)) {
                $data['skin'] = $item->skin;
            }
            if (isset($item->binding)) {
                $data['binding'] = $item->binding;
            }
            if (isset($item->upgrades)) {
                $data['upgrades'] = json_encode($item->upgrades);
            }
            if (isset($item->infusions)) {
                $data['infusions'] = json_encode($item->infusions);
            }

            GWAccount_inventory::create($data);
        }

        GWUpdaters::updateAccountUpdater($user->account->id, 'inventory');
    }

    public static function updateLegendaryarmory($user)
    {
        $response = self::get($user, '/legendaryarmory');
        GWAccount_legendaryarmory::where('gw_account_id', $user->account->id)->delete();

        foreach ($response as $item) {
            GWAccount_legendaryarmory::create([
                'gw_account_id' => $user->account->id,
                'gw_id' => $item->id,
                'count' => $item->count,
            ]);
        }

        GWUpdaters::updateAccountUpdater($user->account->id, 'legendaryarmory');
    }

    public static function updateLuck($user)
    {
        $response = self::get($user, '/luck');
        if ($response) {
            $account = $user->account;
            $account->luck = $response[0]->value;
            $account->save();
        }
    }

    public static function get($user, $path)
    {
        return GWRequest::privateGet(self::getGWObject($user)->getApiKey(), self::getUrl($path));
    }
}
