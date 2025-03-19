<?php

namespace App\Models;
use App\Http\Controllers\RentalController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'id', 'user_id', 'ip_address', 'user_agent', 'payload', 'load_activty'
    ];

    public function user() {
        return $this->belongsTo(RentalController::class);
    }
}
