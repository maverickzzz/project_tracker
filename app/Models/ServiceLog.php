<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'date',
        'owner_id',
        'notes',
    ];

    public function scopeFilter($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
