<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Billing
 *
 * @mixin Eloquent
 */
class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'package_name',
        'package_price',
        'package_start',
        'user_id',
        ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function generateRandomNumber() {
        try {
            $number = random_int(100000, 999999);
        } catch (\Exception $e) {
        }
        if (self::where('invoice', $number)->exists()) {
            return $this->generateRandomNumber();
        }
        return $number;
    }
}
