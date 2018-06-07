<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'name',
    ];

    public function messages()
    {
        return $this->hasMany( Message::class );
    }

    public function participants()
    {
        return $this->belongsToMany( User::class, 'chat_participants' );
    }
}
