<?php

namespace Modules\NsDemoFrontEnd\Console\Commands;

use App\Models\Role;
use App\Services\ModulesService;
use App\Services\ResetService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\NsMultiStore\Models\Store;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ns:demo {demo}';

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
    public function handle( ModulesService $moduleService, ResetService $resetService )
    {
        if ( $moduleService->getIfEnabled( 'NsGastro' ) !== false && $moduleService->getIfEnabled( 'NsMultiStore' ) === false ) {
            $resetService->handleCustom( [
                'mode'  =>  'gastro_demo',
                'with-procurements' =>  true,
                'with-sales'    =>  true,
            ] );
        }

        if ( $moduleService->getIfEnabled( 'NsGastro' ) === false && $moduleService->getIfEnabled( 'NsMultiStore' ) !== false ) {
            /**
             * @var User
             */
            $user   =   Role::namespace( 'admin' )->users()->first();

            Artisan::call( 'multistore:wipe --force' );
            Artisan::call( 'multistore:create "Grocery Master" --user ' . $user->email . '--roles admin' );

            $lastStore  =   Store::orderBy( 'id', 'desc' )->first();
            ns()->store->setStore( $lastStore );
            $this->resetGroceryDemo();
        }

        if ( $moduleService->getIfEnabled( 'NsGastro' ) !== false && $moduleService->getIfEnabled( 'NsMultiStore' ) !== false ) {
            /**
             * @var User
             */
            $user   =   Role::namespace( 'admin' )->users()->first();

            Artisan::call( 'multistore:wipe --force' );
            Artisan::call( 'multistore:create "Chef Master - Restaurant" --user ' . $user->email . '--roles admin --roles ' . Role::STORECASHIER );

            $lastStore  =   Store::orderBy( 'id', 'desc' )->first();
            ns()->store->setStore( $lastStore );
            $this->resetGroceryDemo();
        }

        Artisan::call( 'optimize:clear' );
    }

    public function resetGroceryDemo()
    {
        /**
         * @var ResetService
         */
        $resetService = app()->make(ResetService::class);
        $resetService->softReset();

        /**
         * @var RestaurantDemoService
         */
        $demoService = app()->make(DemoService::class);
        $demoService->run([
            'create_sales'          =>  true,
            'create_procurements'   =>  true,
        ]);
    }

    public function resetRestaurantDemo()
    {
        /**
         * @var ResetService
         */
        $resetService = app()->make(ResetService::class);
        $resetService->softReset();

        /**
         * @var RestaurantDemoService
         */
        $demoService = app()->make(RestaurantDemoService::class);
        $demoService->run([
            'create_sales'          =>  true,
            'create_procurements'   =>  true,
        ]);
    }
}
