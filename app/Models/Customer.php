<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'document', 'document_number'
    ];

    // Relationships
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }

    // Scopes
    public function scopeProviders($query)
    {
        return $query->where('type', 'provider');
    }

    public function scopeClients($query)
    {
        return $query->where('type', 'client');
    }
}
