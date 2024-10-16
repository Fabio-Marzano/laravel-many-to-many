<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'image',
        'type_id'
    ];

    public static function generateSlug($title)
    {
        return Str::slug($title, '_'); 
    }

    public function type() 
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()  
    {
        return $this->belongsToMany(Technology::class);  
    }
}