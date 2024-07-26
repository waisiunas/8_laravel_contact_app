<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'category_id',
        'email',
        'mobile',
        'dob',
        'facebook',
        'instagram',
        'youtube',
        'address',
        'picture',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
