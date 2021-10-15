<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_masterypoints extends Model
{
    use HasFactory;

    protected $table = 'gw_account_masterypoints';
    protected $fillable = [
        'gw_account_id',
        'totals',
        'unlocked',
    ];
}
