<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_name', 'agency', 'account', 'operation', 'balance'
    ];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'bank_account_id', 'id');
    }

}
