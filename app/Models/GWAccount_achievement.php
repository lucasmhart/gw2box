<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_achievement extends Model
{
    use HasFactory;

    protected $table = 'gw_account_achievements';
    protected $fillable = [
        'gw_account_id',
        'gw_achievement_id',
        'bits',
        'current',
        'max',
        'done',
        'repeated',
        'unlocked',
    ];

    public function account()
    {
        return $this->belongsTo(GWAccount::class);
    }
}
