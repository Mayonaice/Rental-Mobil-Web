<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateRentalStatus extends Command
{
    protected $signature = 'rental:update-status';
    protected $description = 'Update rental status to WAITING_PENGEMBALIAN if return date is overdue';

    public function handle()
    {
        $today = Carbon::now();
        
        Rental::where('status', 'ON_RENTAL')
            ->where('waktu_pengembalian', '<', $today)
            ->update(['status' => 'WAITING_PENGEMBALIAN']);

        $this->info('Rental status updated successfully.');
    }
}
