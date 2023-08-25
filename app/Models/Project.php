<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'owner_id',
        'url',
        'is_active'
    ];
    // protected $with = ['owner', 'payments'];

    public function owner()
    {
        return $this->belongsTo(ProjectOwner::class)->orderBy('name');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('date');
    }

    public function scopeFilter($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [
        'name' => 'string',
        'user_id' => 'int',
        'owner_id' => 'int',
        'url' => 'string',
        'is_active' => 'boolean'
    ];
}
