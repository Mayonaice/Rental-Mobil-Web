<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Traits\Dumpable;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory, Notifiable, Dumpable;
  
    protected $fillable = [
        'user_id', 'product_id', 'status', 'unit_pinjam', 'waktu_pinjam', 'waktu_pengembalian', 'total_harga', 'bukti_pengembalian'
    ];

    protected static function booted()
    {
        static::retrieved(function ($rental) {
            if ($rental->status === 'ON_RENTAL' && $rental->waktu_pengembalian < Carbon::now()) {
                Rental::where('id', $rental->id)
                      ->where('status', 'ON_RENTAL') // Double check status to avoid overwriting
                      ->update(['status' => 'WAITING_PENGEMBALIAN']);
            }
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
