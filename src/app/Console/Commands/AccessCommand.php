<?php

namespace SecurityTools\LaravelAccess\Console\Commands;

use Illuminate\Console\Command;

class AccessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install access';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->migrate();
    }

    /**
     * Execute the migrations.
     */
    public function migrate(): void
    {
        $this->info('Publishing access migrations...');
        $this->call('migrate', ['--force' => true]);
        $this->info('Access migrations published');
    }
}
