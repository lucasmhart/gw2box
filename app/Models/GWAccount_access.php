<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GWAccount_access extends Model
{
    use HasFactory;
    protected $table = 'gw_account_accesses';
    protected $fillable = [
        'gw_account_id',
        'access',
    ];

    public function account()
    {
        return $this->belongsTo(GWAccount::class);
    }
}
