<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_raids extends Model
{
    use HasFactory;

    protected $table = 'gw_account_raids';
    protected $fillable = [
        'gw_account_id',
        'gw_ids',
    ];
}
