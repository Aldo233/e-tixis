<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'event_id',
    'tanggal_pesan',
    'status',
];
    public function user()
{
    return $this->belongsTo(User::class);
}

public function event()
{
    return $this->belongsTo(Event::class);
}

public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
