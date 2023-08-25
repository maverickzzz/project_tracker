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

    protected $casts = [
        'project_id' => 'int',
        'user_id' => 'int',
        'date' => 'string',
        'owner_id' => 'int',
        'notes' => 'string'
    ];
}
