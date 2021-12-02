<?php

namespace App\Console\Commands;

use App\Models\House;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetupApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application by creating the first user and the first home';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Hi and thank you for using HouseHold Financies! Please follow the steps and I hope this Open Source Project can help you in your everyday life!");
        $email = $this->ask("Write your email address (admin@admin.test):");
        $name = $this->ask("Enter your name or a username (admin):");
        $password = $this->secret("Choose a password (secret):");
        $houseName = $this->ask("Choose your house name:");
        $bar = $this->output->createProgressBar(3);
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        if($user->save()){
            $bar->advance(1);
            $house = new House;
            $house->name = $houseName;
            if($house->save()){
                $bar->finish();
                $this->info("Your system is ready for being used.");
                $this->newLine(3);
                $this->line("If you want to contribute, you can buy me a coffee: buymeacoffee.com/albisanti");
                $this->line("Thank you in advance and happy coding :)");
            }
        }
        return Command::SUCCESS;
    }
}
