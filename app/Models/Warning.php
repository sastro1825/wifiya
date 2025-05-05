<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'wifi_package', 'message', 'sent_at'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function wifiUser()
    {
        return $this->belongsTo(WifiUser::class, 'user_id', 'user_id');
    }
}