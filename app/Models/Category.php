<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // public function article() // ternyata ini gk perlu, cukup relasi one to one disisi model artikel
    // {
    //     return $this->hasOne(Article::class);
    // }
}
