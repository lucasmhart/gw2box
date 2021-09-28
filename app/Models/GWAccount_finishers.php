<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_finishers extends Model
{
    use HasFactory;
    protected $table = 'gw_account_finishers';
    protected $fillable = [
        'gw_account_id',
        'finishers',
    ];
}
