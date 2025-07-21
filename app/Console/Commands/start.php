<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class start extends Command
{
    protected $signature = 'start';
    protected $description = 'Inicia Reverb, Laravel e Vite com um único comando';

    public function handle()
    {
        $this->info('Iniciando tudo...');

        // Inicia o Laravel Reverb
        $this->info('Iniciando Reverb...');
        new Process(['php', 'artisan', 'reverb:start'], null, null, null, null);
        shell_exec('start /B php artisan reverb:start'); // Windows
        // shell_exec('php artisan reverb:start > /dev/null 2>&1 &'); // Linux/macOS

        // Inicia o Laravel server
        $this->info('Iniciando Laravel...');
        shell_exec('start /B php artisan serve'); // Windows
        // shell_exec('php artisan serve > /dev/null 2>&1 &'); // Linux/macOS

        // Inicia o Vite/NPM
        $this->info('Iniciando Vite (npm run dev)...');
        shell_exec('start /B npm run dev'); // Windows
        // shell_exec('npm run dev > /dev/null 2>&1 &'); // Linux/macOS

        $this->info('Tudo iniciado com sucesso! 🚀');
        return Command::SUCCESS;
    }
}
