<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_path',
        'status'
    ];

    // ✅ Relationship inside class
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);

    }
}