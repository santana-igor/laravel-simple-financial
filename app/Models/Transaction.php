<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'invoice_id', 'bank_account_id', 'traded_at'
    ];

    // Relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id', 'invoice_id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(Invoice::class, 'id', 'bank_account_id');
    }
}
