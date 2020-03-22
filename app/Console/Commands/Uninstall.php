<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Uninstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gundalacms:cabut';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall GundalaCMS';

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
        //
        $this->line('--------------- Uninstall GundalaCMS ----------------');
        $this->line('Uninstall berlangsung...');
        Artisan::call('migrate:rollback', [
            '--path' => 'database/migrations',
            '--force' => true
        ]);
        $this->line('-----------Uninstall telah selesai--------------');
    }
}
