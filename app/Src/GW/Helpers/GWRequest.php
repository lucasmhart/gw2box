<?php

namespace App\Src\GW\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use stdClass;

class GWRequest
{
    public const API_BASE_URL = 'https://api.guildwars2.com/v2';

    public static function publicGet()
    {
    }

    public static function publicPost()
    {
    }
    public static function privateGet($key, $endpoint)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $key
        ])->get($endpoint);

        return $response->object();
    }
    public static function privatePost($key, $endpoint)
    {
    }
}
