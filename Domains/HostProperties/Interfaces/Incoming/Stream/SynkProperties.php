<?php

namespace Domains\HostProperties\Interfaces\Incoming\Stream;

use Domains\HostProperties\Domain\Model\Property\Property;
use Illuminate\Console\Command;

class SynkProperties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:synk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync pending properties';

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
     * @param  Property $property
     * @return mixed
     */
    public function handle(Property $property)
    {
        //$property->createNew();
    }
}
