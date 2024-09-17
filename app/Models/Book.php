<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $keyType = 'int';
    protected $primaryKey = 'id';

    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [];
}
