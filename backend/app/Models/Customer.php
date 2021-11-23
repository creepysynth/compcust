<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const SORTABLE = [
        'id',
        'name',
        'email',
        'phone',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone'
    ];

    protected $hidden = ['pivot'];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }
}
