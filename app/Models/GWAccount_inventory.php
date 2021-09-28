<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_inventory extends Model
{
    use HasFactory;

    protected $table = 'gw_account_inventories';
    protected $fillable = [
        'gw_account_id',
        'gw_id',
        'count',
        'charges',
        'skin',
        'upgrades',
        'infusions',
        'binding',
    ];
}
