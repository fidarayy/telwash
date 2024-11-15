<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'payment_method',
        'amount',
        'status',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
