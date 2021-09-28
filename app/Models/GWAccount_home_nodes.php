<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_home_nodes extends Model
{
    use HasFactory;

    protected $table = 'gw_account_home_nodes';
    protected $fillable = [
        'gw_account_id',
        'nodes',
    ];
}
