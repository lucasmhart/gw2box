<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_materials extends Model
{
    use HasFactory;

    protected $table = 'gw_account_materials';
    protected $fillable = [
        'gw_account_id',
        'gw_id',
        'category',
        'binding',
        'count',
    ];
}
