<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe_user');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_recipe_user');
    }

}
