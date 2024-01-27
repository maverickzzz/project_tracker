<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'usergroups';

    protected $guarded = [];

    public function scopeFilter($query)
    {
        if (auth()->user() && auth()->user()->id === 1) {
            return $query;
        }
        return $query->where('name', '<>', 'administrator');
    }
}
