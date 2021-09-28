<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_emotes extends Model
{
    use HasFactory;

    protected $table = 'gw_account_emotes';
    protected $fillable = [
        'gw_account_id',
        'emotes',
    ];
}
