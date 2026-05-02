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
    protected static function booted()
    {
        static::creating(function ($target){
            $latest = static::latest('id')->first();
            $number = $latest ? (int) str_replace('SX-', '', $latest->case_id) + 1 : 1;
            $target->case_id = 'SX-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}
