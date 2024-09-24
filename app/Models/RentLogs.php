<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLogs extends Model
{
    use HasFactory;

    public $table = 'rent_logs';
    public $incrementing = true;
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'user_id',
        'book_id',
        'rent_date',
        'return_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
