<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_home_cats extends Model
{
    use HasFactory;

    protected $table = 'gw_account_home_cats';
    protected $fillable = [
        'gw_account_id',
        'cats',
    ];
}
