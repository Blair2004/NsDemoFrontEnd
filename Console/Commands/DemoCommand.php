<?php

namespace Modules\NsDemoFrontEnd\Console\Commands;

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
        switch( $this->argument( 'demo' ) ) {
            case 'gastro':
                break;
            case 'multistore':
                break;
        }
    }
}
