<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Foundation\Console\TestMakeCommand as BaseCommand;

class TestMakeCommand extends BaseCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:phpunit {name : The name of the class} {--unit : Create a unit test}';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return 1;
        }
        return 0;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/unit_test.stub';
    }
}
