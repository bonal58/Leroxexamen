<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name?} {email?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Maak een nieuwe admin gebruiker aan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name') ?? $this->ask('Wat is de naam van de admin?');
        $email = $this->argument('email') ?? $this->ask('Wat is het e-mailadres van de admin?');
        $password = $this->argument('password') ?? $this->secret('Wat is het wachtwoord van de admin?');

        // Controleer of de gebruiker al bestaat
        $existingUser = User::where('email', $email)->first();
        
        if ($existingUser) {
            if ($this->confirm("Een gebruiker met e-mail {$email} bestaat al. Wil je deze updaten naar admin?")) {
                $existingUser->role = 'admin';
                $existingUser->save();
                $this->info("Gebruiker {$email} is nu een admin.");
                return;
            } else {
                $this->error("Operatie geannuleerd.");
                return;
            }
        }

        // Maak een nieuwe admin gebruiker aan
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Admin gebruiker {$email} is succesvol aangemaakt.");
    }
}
