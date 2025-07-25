<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class DataInputMakeTest extends TestCase
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

    /**
     * Test the DataInputMake command.
     *
     * @return void
     */
    public function testEnsureBaseIsCreated()
    {
        $this->artisan('make:data:input', ['name' => 'Test'])
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:data:input', ['name' => 'Test'])
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:data:input', ['name' => 'Test'])
            ->expectsOutput('Input Data already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:data:input', ['name' => 'Test'])
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:data:input', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
    }
}
