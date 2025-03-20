<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; 

    protected $fillable = ['nama_produk', 'harga', 'deskripsi', 'stok','gambar', 'kategori_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class, 'kategori_id');
}

    
}
