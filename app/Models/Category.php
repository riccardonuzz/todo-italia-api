<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];    

    public function todos() {
        // hasOne, hasMany, belongsTo, belongsToMany
        
        return $this->belongsToMany(
            Todo::class,
            'categories_todos',
            'category_id',
            'todo_id');
    }
}
