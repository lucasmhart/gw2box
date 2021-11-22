<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_pvp_heroes extends Model
{
    use HasFactory;

    protected $table = 'gw_account_pvp_heroes';
    protected $fillable = [
        'gw_account_id',
        'gw_ids',
    ];
}
