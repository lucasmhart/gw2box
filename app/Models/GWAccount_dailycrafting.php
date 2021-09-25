<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_dailycrafting extends Model
{
    use HasFactory;

    protected $table = 'gw_account_dailycraftings';
    protected $fillable = [
        'gw_account_id',
        'items',
    ];
}
