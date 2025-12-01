<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id' , 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
