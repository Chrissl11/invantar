<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearSessionPayload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear-payload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the payload column in the sessions table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('sessions')->update(['payload' => '']);

        $this->info('Session payloads have been cleared successfully.');

        return 0;
    }
}
