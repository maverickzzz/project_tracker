<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'date',
        'amount',
        'owner_id',
        'notes',
        'currency'
    ];

    // protected $with = ['project'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class)->orderBy('name');
    }

    public function scopeFilter($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [
        'project_id' => 'int',
        'user_id' => 'int',
        'date' => 'string',
        'amount' => 'int',
        'owner_id' => 'int',
        'notes' => 'string',
        'currency' => 'string'
    ];

}
