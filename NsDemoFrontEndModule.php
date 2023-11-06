<?php
namespace Modules\NsDemoFrontEnd;

use Illuminate\Support\Facades\Event;
use App\Services\Module;

class NsDemoFrontEndModule extends Module
{
    public function __construct()
    {
        parent::__construct( __FILE__ );
    }
}