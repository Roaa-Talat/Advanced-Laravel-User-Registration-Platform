<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name', // Add 'name' to the fillable array
        'user_name',
        'email',
        'password',
        'birthdate',
        'phone',
        'address',
        'user_image',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'user_image' => 'string',
        ];
    }
}
