<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class SetupCacheDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * You can run this as: php artisan setup:cache-dirs
     */
    protected $signature = 'setup:cache-dirs';

    /**
     * The console command description.
     */
    protected $description = 'Setup necessary storage and cache directories with correct permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up directories...');

        $command = <<<EOT
                    mkdir -p /app/storage/framework/sessions /app/storage/framework/views /app/storage/framework/cache/data &&
                    mkdir -p /app/bootstrap/cache &&
                    chown -R www-data:www-data /app/storage /app/bootstrap/cache &&
                    chmod -R 775 /app/storage /app/bootstrap/cache
                    EOT;

        $process = Process::fromShellCommandline($command);

        // Run as root, or ensure proper permissions for chown/chmod to work
        $process->setTimeout(60);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info('Directories set up successfully.');
        } else {
            $this->error('Error setting up directories: ' . $process->getErrorOutput());
        }
    }
}
