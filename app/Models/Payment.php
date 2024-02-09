<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * User
 *
 * @mixin Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['billing_id', 'user_id', 'invoice', 'payment_method', 'package_price '];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billing(){
        return $this->belongsTo(Billing::class);
    }
}
