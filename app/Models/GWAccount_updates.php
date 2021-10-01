<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_updates extends Model
{
    use HasFactory;

    protected $table = 'gw_account_updates';

    protected $fillable =  [
        'gw_account_id',
        'account',
        'achievements',
        'bank',
        'buildstorage',
        'dailycrafting',
        'dungeons',
        'dyes',
        'emotes',
        'finishers',
        'gliders',
        'home',
        'home_cats',
        'home_nodes',
        'inventory',
        'legendaryarmory',
        'mailcarriers',
        'mapchests',
        'masteries',
        'mastery_points',
        'materials',
        'minis',
        'mounts',
        'mounts_skins',
        'mounts_types',
        'novelties',
        'outfits',
        'pvp_herores',
        'raids',
        'recipes',
        'skins',
        'titles',
        'wallet',
        'worldbosses',
    ];

    protected $dates = [
        'account',
        'achievements',
        'bank',
        'buildstorage',
        'dailycrafting',
        'dungeons',
        'dyes',
        'emotes',
        'finishers',
        'gliders',
        'home',
        'home_cats',
        'home_nodes',
        'inventory',
        'legendaryarmory',
        'luck',
        'mailcarriers',
        'mapchests',
        'masteries',
        'mastery_points',
        'materials',
        'minis',
        'mounts',
        'mounts_skins',
        'mounts_types',
        'novelties',
        'outfits',
        'pvp_herores',
        'raids',
        'recipes',
        'skins',
        'titles',
        'wallet',
        'worldbosses',
    ];

    public function account()
    {
        return $this->belongsTo(GWAccount::class, 'id', 'gw_account_id');
    }
}
