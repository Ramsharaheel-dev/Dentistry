<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StudentNotesDelete extends Command
{

    protected $signature = 'notes:delete';

    protected $description = 'Command description';

    public function handle()
    {
        $thresholdDateTime = Carbon::now()->subHours(24);

        $deleteCount = DB::table('saved_speech_to_text')
            ->where('created_at', '<', $thresholdDateTime)
            ->delete();

        $this->info("Deleted Speech Text $deleteCount records older than 24 hours.");
    }
}
