<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssistDelete extends Command
{
    protected $signature = 'records:delete';

    protected $description = 'Delete older records';


    public function handle()
    {
        $thresholdDateTime = Carbon::now()->subHours(24);

        $deleteCount = DB::table('patient_notes')
            ->where('created_at', '<', $thresholdDateTime)
            ->delete();

        $this->info("Deleted $deleteCount records older than 24 hours.");
    }
}
