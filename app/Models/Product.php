<?php

namespace App\Models;

use App\Http\Controllers\RentalController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'nama_mobil', 'category_id', 'tahun', 'harga_sewa', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rental() {
        return $this->HasMany(Rental::class);
    }
}
