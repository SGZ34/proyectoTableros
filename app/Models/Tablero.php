<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    use HasFactory;

    protected $table = 'tableros';

    protected $fillable = ['title', 'description', 'state', 'file', 'idMime'];

    public $timestamps = true;
}
