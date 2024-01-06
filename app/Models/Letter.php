<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_type_id',
        'letter_perihal',
        'recipients',
        'content',
        'attachment',
        'notulis'
    ];

    protected $casts = [
        'recipients' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'notulis');
    }

    public function  result()
    {
        return $this->hasMany(Result::class);
    }

    public function letter_type() 
    {
        return $this->belongsTo(Letter_type::class);
    }
}
