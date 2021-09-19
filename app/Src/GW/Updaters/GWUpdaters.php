<?php

namespace App\Src\GW\Updaters;

use App\Models\GWAccount_updates;
use Carbon\Carbon;

class GWUpdaters
{
    public static function updateAccountUpdater($account_id, $field)
    {
        GWAccount_updates::updateOrCreate(
            ['gw_account_id' => $account_id],
            [$field => Carbon::now()]
        );
    }
}
