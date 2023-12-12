<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_type',
        'amount',
        'status',
        'proof_payment',
        'due_date',
        'users_id'
    ];
}
