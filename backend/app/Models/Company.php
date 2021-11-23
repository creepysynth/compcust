<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    const SORTABLE = [
        'id',
        'name',
        'address',
        'phone',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone'
    ];

    protected $hidden = ['pivot'];

    /**
     * Many-to-many relation to customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class)->withTimestamps();
    }
}
