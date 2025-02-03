<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'item_id',
        'claimer_name',
        'claimer_email',
        'proof_description',
        'verified'
    ];

    protected $casts = [
        'verified' => 'boolean'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
