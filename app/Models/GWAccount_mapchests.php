<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_mapchests extends Model
{
    use HasFactory;

    protected $table = 'gw_account_mapchests';
    protected $fillable = [
        'gw_account_id',
        'mapchests',
    ];
}
