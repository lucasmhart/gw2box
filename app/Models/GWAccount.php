<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount extends Model
{
    use HasFactory;
    protected $table = 'gw_accounts';
    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function access()
    {
        return $this->hasMany(GWAccount_access::class, 'gw_account_id');
    }

    public function guilds()
    {
        return $this->hasMany(GWAccount_guilds::class, 'gw_account_id');
    }

    public function achievements()
    {
        return $this->hasMany(GWAccount_achievement::class, 'gw_account_id');
    }

    public function updates()
    {
        return $this->hasOne(GWAccount_updates::class, 'gw_account_id');
    }
}
