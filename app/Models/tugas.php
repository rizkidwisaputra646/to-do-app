<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tugas extends Model
{

    protected $table = 'tugas';
    protected $fillable = [
        'nama_tugas',
        'is_completed'
    ];
}
