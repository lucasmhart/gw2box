<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_dungeon extends Model
{
    use HasFactory;

    protected $table = 'gw_account_dungeons';
    protected $fillable = [
        'gw_account_id',
        'dungeons',
    ];
}
