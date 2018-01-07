<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ip;

class Jail extends Model
{
    protected $fillable = [
        'hostname', 'ip_id', 'quota', 'ssh_key',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ip()
    {
        return $this->belongsTo(Ip::class, 'ip_id', 'id');
    }
}
