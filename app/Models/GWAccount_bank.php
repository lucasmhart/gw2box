<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_bank extends Model
{
    use HasFactory;

    protected $table = 'gw_account_banks';
    protected $fillable = [
        'gw_account_id',
        'gw_id',
        'count',
        'charges',
        'skin',
        'dyes',
        'upgrades',
        'upgrade_slot_indices',
        'infusions',
        'bindings',
        'binding_to',
        'stats',
    ];

    public function account()
    {
        return $this->belongsTo(GWAccount::class, 'id', 'gw_account_id');
    }
}
