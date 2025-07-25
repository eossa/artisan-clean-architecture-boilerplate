<?php

namespace Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class ViewModelMakeTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  Application  $app
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
        $this->artisan('make:view-model', ['name' => 'Test'])
            ->expectsOutput('ViewModel created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/ViewModels/Test.php'));
        $this->app['files']->delete(app_path('Domain/ViewModels/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:view-model', ['name' => 'Test'])
            ->expectsOutput('ViewModel created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:view-model', ['name' => 'Test'])
            ->expectsOutput('ViewModel already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/ViewModels/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:view-model', ['name' => 'Test'])
            ->expectsOutput('ViewModel created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:view-model', ['name' => 'Test', '--force' => true])
            ->expectsOutput('ViewModel created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Domain/ViewModels/Test.php'));
    }
}
