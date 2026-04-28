<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = ['name', 'username', 'email', 'notes', 'status', 'image'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function evidences()
    {
        return $this->hasMany(Evidence::class);
    }
}
