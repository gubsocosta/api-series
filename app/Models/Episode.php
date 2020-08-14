<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'season',
        'number',
        'serie_id',
        'viewed'
    ];

    public function Serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
