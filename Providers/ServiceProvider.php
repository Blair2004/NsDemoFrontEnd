<?php
namespace Modules\NsDemoFrontEnd\Providers;

use App\Classes\Hook;
use Illuminate\Support\ServiceProvider;
use Modules\NsDemoFrontEnd\Events\NsDemoFrontEndEvent;

class NsDemoFrontEndServiceProvider extends ServiceProvider
{
    protected $event;
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->event    =   new NsDemoFrontEndEvent;

        Hook::addAction( 'ns.before-login-fields', [ $this->event, 'header' ]);
        Hook::addAction( 'ns.after-login-fields', [ $this->event, 'footer' ]);   
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap any services that your module needs here
    }
}
