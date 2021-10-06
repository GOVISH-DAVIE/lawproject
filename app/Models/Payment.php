<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'record_id',
        'amount'
    ];
    public function record()
    {
        return $this->belongsTo(Records::class,'record_id','id');
    }
}
