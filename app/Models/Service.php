<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'owner_id',
        'project_id',
        'start_date',
        'end_date',
        'currency',
        'amount',
        'notes',
        'is_active'
    ];

    public function scopeFilter($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [
        'user_id' => 'int',
        'type' => 'string',
        'owner_id' => 'int',
        'project_id' => 'int',
        'start_date' => 'string',
        'end_date' => 'string',
        'currency' => 'string',
        'amount' => 'int',
        'notes' => 'string',
        'is_active' => 'boolean'
    ];
}
