<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Detail
 *
 * @mixin Eloquent
 */

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'dob',
        'pin',
        'router_password',
        'package_name',
        'package_price',
        'package_start',
        'due',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
