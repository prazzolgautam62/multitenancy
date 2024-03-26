<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\Tenant\SingleTenantSeeder;


class SingleTenantSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed:tenant:single';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seeding on creating single tenant';

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
        Artisan::call('db:seed', [
            '--database' => 'tenant',
			'--class'    => SingleTenantSeeder::class,
		]);
    }
}
