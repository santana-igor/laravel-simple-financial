<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checked', 'type', 'nickname', 'reference_number', 'amount', 'description', 'customer_id', 'category_id', 'issued_at', 'expired_at'
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
}
