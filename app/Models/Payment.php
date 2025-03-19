<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'rental_id', 'master_payment_id', 'nama_akun', 'no_rek', 'no_hp', 'status', 'bukti_pembayaran'
    ];

    public function rental() {
        return $this->belongsTo(Rental::class);
    }

    public function masterpayment() {
        return $this->belongsTo(MasterPayment::class);
    }
}
