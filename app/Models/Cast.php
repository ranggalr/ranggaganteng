<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = ['name','gender','profile_path'];

    public function movies()
    {
        return $this->belongsToMany('App\Models\Movies');
    }
}
