<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RunComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gundalacms:composer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test run composer';

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
     * @return mixed
     */
    public function handle()
    {

        $this->line('------- Install Depedenncies ------------');
        $process = new Process('composer install');
        $process->run();
        $this->info('selesai');
    }
}
