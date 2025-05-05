<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'password', 'wifi_package'];
}