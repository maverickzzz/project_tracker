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
}
