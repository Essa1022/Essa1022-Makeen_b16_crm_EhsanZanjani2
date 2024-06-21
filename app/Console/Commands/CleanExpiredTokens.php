<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean expired tokens from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = DB::table('personal_access_tokens')
            ->where('expires_at', '<', now())
            ->delete();
        $this->info('Deleted ' . $token . ' expired tokens.');
    }
}
