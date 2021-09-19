<?php

namespace App\Src\GW\Updaters;

use App\Models\GWAccount as ModelsGWAccount;
use App\Models\GWAccount_access;
use App\Models\GWAccount_guilds;
use App\Src\GW\Helpers\GWObject;
use App\Src\GW\Helpers\GWRequest;
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
}
