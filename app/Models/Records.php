<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'date',
        'location',
        'amount',
        'des',
        'email',
        'tel',
        'docs',
        'user_id',
        'clientname',
        'filenumber'
    ];
    public function payments()
    {
        return $this->hasMany(Payment::class, 'record_id', 'id');
        # code...
    }
    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
}
