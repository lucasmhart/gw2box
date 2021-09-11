<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount extends Model
{
    use HasFactory;
    protected $table = 'gw_accounts';
    protected $fillable = [
        'gw_id',
        'age',
        'name',
        'world',
        'created',
        'commander',
        'fractal_level',
        'daily_ap',
        'monthly_ap',
        'wvw_rank',
        'last_modified',
    ];

    public function access()
    {
        return $this->hasMany(GWAccount_access::class);
    }

    public function guilds()
    {
        return $this->hasMany(GWAccount_guilds::class);
    }
}
