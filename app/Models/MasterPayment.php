<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_payment', 'nama_akun', 'no_rek', 'no_hp', 'qrcode'
    ];

    // One-to-Many Relationship: A Category has many Products
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
