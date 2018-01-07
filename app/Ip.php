<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Jail;

class Ip extends Model
{
    protected $fillable = [
        'name', 'ip',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jail()
    {
        return $this->hasOne(Jail::class,  'ip_id', 'id');
    }
}
