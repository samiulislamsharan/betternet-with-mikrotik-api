<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Package
 *
 * @mixin Eloquent
 */
class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];
}
