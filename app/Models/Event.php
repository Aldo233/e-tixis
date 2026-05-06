<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Event extends Model
{
    protected $fillable = [
    'nama_event',
    'tanggal',
    'lokasi',
    'kuota',
]; 
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}