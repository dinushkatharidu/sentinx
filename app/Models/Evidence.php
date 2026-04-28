<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $fillable = ['target_id', 'file_path', 'file_type', 'original_name'];

    public function target()
    {
        return $this->belongsTo(Target::class);
    }
}
