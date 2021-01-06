<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','rating','duration','release_date','poster_path','trailer_link','slug'];

    public function casts()
    {
        return $this->belongsToMany('App\Models\Cast');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

    public function sources()
    {
        return $this->hasMany('App\Models\Source');
    }
}
