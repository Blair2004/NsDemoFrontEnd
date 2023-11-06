<?php
namespace Modules\NsDemoFrontEnd\Events;

use App\Classes\Output;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

/**
 * Register Event
**/
class NsDemoFrontEndEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        // ...
    }

    public function header( Output $response ) 
    {
        $response->addOutput( View::make( 'NsDemoFrontEnd::login.header' ) );
    }

    public function footer( Output $response ) 
    {
        $response->addOutput( View::make( 'NsDemoFrontEnd::login.footer' ) );
    }
}