<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Book;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('follow');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
