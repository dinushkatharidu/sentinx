<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = ['name', 'username', 'email', 'notes', 'status'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
