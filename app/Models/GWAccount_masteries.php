<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_masteries extends Model
{
    use HasFactory;

    protected $table = 'gw_account_masteries';
    protected $fillable = [
        'gw_account_id',
        'gw_id',
        'level',
    ];
}
