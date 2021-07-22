<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model 
{
    use HasFactory;

    protected $with = ['categories'];

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

    public function scopeFilter($query, array $filters) {
        $query
            ->when(
                $filters['search'] ?? false,
                fn ($query, string $search) =>
                    $query->where(fn ($query) => $query
                          ->where('title', 'like', '%' . $search . '%')
                          ->orWhere('body', 'like', '%' . $search . '%'))
            );

        $query
            ->when(
                $filters['category'] ?? false,
                fn ($query, string $category) =>
                    $query->whereHas('categories', fn ($query) =>
                        $query->where('category_id', $category))
            );

        if (isset($filters['done']) && is_string($filters['done'])) {
            $query->where('done', $filters['done']);
        }

        return $query;
    }

    public function categories() {
        // hasOne, hasMany, belongsTo, belongsToMany

        return $this->belongsToMany(
            Category::class,
            'categories_todos',
            'todo_id',
            'category_id');
    }

    public function owner()
    {
        // there should be an 'owner_id' key in db but we got 'user_id' so we have to specify the foreign key
        // hasOne, hasMany, belongsTo, belongsToMany

        return $this->belongsTo(User::class, 'user_id');
    }
}
