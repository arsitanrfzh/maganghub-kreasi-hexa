<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // Izinkan semua kolom diisi (mass assignable)
    protected $guarded = ['id'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
