<?php

namespace Modules\NsDemoFrontEnd\Console\Commands;

use App\Services\ResetService;
use Illuminate\Console\Command;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:reset {demo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will dispatch demo reset job for the given demo';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * @var ResetService
         */
        $resetService = app()->make( ResetService::class );

        switch( $this->argument( 'demo' ) ) {
            case 'gastro':
                $resetService->handleCustom( [
                    'mode'  =>  'gastro_demo',
                    'with-procurements' =>  true,
                    'with-sales'    =>  true,
                ] );
                break;
            case 'multistore':
                break;
        }
    }
}
