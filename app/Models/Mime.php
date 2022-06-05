<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mime extends Model
{
    use HasFactory;

    protected $table = 'mimes';

    protected $fillable = ['id', 'name', 'description'];

    public $timestamps = false;
}
