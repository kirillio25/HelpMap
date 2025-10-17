<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    // Поля, которые можно заполнять массово
    protected $fillable = ['user_id', 'description', 'coordinates',
        'is_active', 'fullName', 'phone', 'location'];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
