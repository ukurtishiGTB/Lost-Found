<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'category',
        'status',
        'date_found',
        'image',
        'reporter_name',    // Add reporter's name
        'reporter_email',   // Add reporter's email
    ];

    protected $casts = [
        'date_found' => 'date',
    ];

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }
}
