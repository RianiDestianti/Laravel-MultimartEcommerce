<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'keyword']; // Tambahkan 'user_id' di sini

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
