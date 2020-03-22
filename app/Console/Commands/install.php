<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gundalacms:pasang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proses instalasi GundalaCMS sedang berlangsung';

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
        $this->line('--------------- Instalasi GundalaCMS ----------------');

        // $this->line('Menghapus Database Lama.');
        // Artisan::call('database:delete', ['db_name' => env('DB_DATABASE')]);

        // $this->line('Membuat Database baru');
        // Artisan::call('database:create', ['db_name' => env('DB_DATABASE')]);

        $this->line('1. Menjalankan migrasi database...');
        // $this->line('Butuh beberapa saat mohon bersabar......');
        // Artisan::call('database:migrate:fresh');
        // Update the Tenant DB Name in Configuration
        // config()->set('database.connections.mysql.database', env('DB_DATABASE'));
        // DB::connection('mysql')->reconnect();

        Artisan::call('migrate:fresh', [
            '--path' => 'database/migrations',
            '--force' => true
        ]);

        $this->line('>>>>> migrasi database berhasil.');

        $this->line('2. Menjalankan konfigurasi database...');
        Artisan::call('db:seed', [
            '--class' => 'Setup'
        ]);
        // Artisan::call('database:user:seed');

        $this->line('>>>>> konfigurasi database berhasil.');
        // $this->line('Butuh beberapa saat mohon bersabar......');
        // Artisan::call('database:role:seed');

        $this->line('3. Menjalankan konfigurasi environment aplikasi...');
        Artisan::call('key:generate');
        Artisan::call('config:clear');
        Artisan::call('config:cache');

        $this->line('>>>>> konfigurasi environment berhasil.');

        $path = public_path().'/storage';

        $this->line('4. Memeriksa public storage...');

        if (!file_exists($path)) {
            Artisan::call('storage:link');
            $this->line('>>>>> public storage berhasil dibuat.');
        }
        else
        {
            $this->line('>>>>> public storage telah tersedia.');
        }

        $this->line('--------------Instalasi telah selesai, Selamat Menggunakan GundalaCMS---------------');
    }
}
