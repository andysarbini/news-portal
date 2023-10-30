<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    // public function role()
    // {
    //     return $this->hasOne(Role::class, 'id', 'role_id');
    // }

    // public function category()
    // {
    //     return $this->hasOne(Category::class, 'category', 'id');
    // }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'publish':
                $color = 'success';
                break;
            case 'archived':
                $color = 'dark';
                break;
            case 'pending':
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
    }

}
