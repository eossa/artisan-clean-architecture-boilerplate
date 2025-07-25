<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class DataOutputMakeTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['EOssa\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureBaseIsCreated()
    {
        $this->artisan('make:data:output', ['name' => 'Test'])
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:data:output', ['name' => 'Test'])
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:data:output', ['name' => 'Test'])
            ->expectsOutput('Output Data already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:data:output', ['name' => 'Test'])
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:data:output', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }
}
