<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\User;

class GenerateApiKey extends Command
{
    protected $signature = 'api-key:generate {userId}';
    protected $description = 'Generate a new API key for a user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found');
            return 1;
        }

        // Generate a new API key
        $user->api_key = Str::random(64);
        $user->save();

        $this->info('API key generated for user ' . $userId);
        return 0;
    }
}
