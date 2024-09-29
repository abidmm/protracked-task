<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'policy_premium',
        'policy_commission',
        'transaction_date',
    ];
}
