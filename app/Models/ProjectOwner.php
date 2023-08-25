<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'country',
        'contact_number'
    ];
    // protected $with = ['projects', 'payments'];

    // public function projects()
    // {
    //     return $this->hasMany(Project::class)->orderBy('name');
    // }

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class)->orderBy('name');
    // }

    public function scopeFilter($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    protected $casts = [
        'name' => 'string',
        'user_id' => 'int',
        'country' => 'string',
        'contact_number' => 'string'
    ];
}
