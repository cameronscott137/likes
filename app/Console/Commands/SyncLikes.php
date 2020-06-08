<?php

namespace App\Console\Commands;

use App\Like;
use Illuminate\Console\Command;
use App\Services\Twitter;

class SyncLikes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cameron:fetch-likes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Likes from the Twitter API';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Twitter $twitter)
    {
        $twitter->syncLikes();
    }
}
