<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_guilds extends Model
{
    use HasFactory;
    protected $table = 'gw_account_guilds';

    protected $fillable = [
        'gw_account_id',
        'gw_guild_id',
        'is_guild_leader',
    ];

    public function account()
    {
        return $this->belongsTo(GWAccount::class, 'id', 'gw_account_id');
    }
}
