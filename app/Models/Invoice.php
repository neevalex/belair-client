<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'user_id',
        'number',
        'date',
        'amount',
        'status',
        'description',
        'type',
    ];

    //relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
