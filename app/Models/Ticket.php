<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'message', 'status', 'priority', 'user_id', 'number'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateRandomNumber() {
        try {
            $number = random_int(100000, 999999);
        } catch (\Exception $e) {
        }
        if (self::where('number', $number)->exists()) {
            return $this->generateRandomNumber();
        }
        return $number;
    }
}
