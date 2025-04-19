<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateAuthToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a test token for a user. Creates the user if they do not exist.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // Find or create the user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Test User',
                'password' => Hash::make(Str::random(32)),
            ]
        );

        // Create a new token
        $token = $user->createToken('test-token')->plainTextToken;

        $this->info('Token generated successfully:');
        $this->line($token);

        return Command::SUCCESS;
    }
}
