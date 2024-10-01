<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class PresenterMakeTest extends TestCase
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
        return ['WasiCo\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureDefaultIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureDefaultIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Test'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureHttpIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--http' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureExistingHttpIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--http' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--http' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureHttpIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--http' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--force' => true, '--http' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureCliIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--cli' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestCli.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestCli.php'));
    }

    public function testEnsureExistingCliIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--cli' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--cli' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestCli.php'));
    }

    public function testEnsureCliIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--cli' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--force' => true, '--cli' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestCli.php'));
    }

    public function testEnsureJsonIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--json' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestJson.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestJson.php'));
    }

    public function testEnsureExistingJsonIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--json' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--json' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestJson.php'));
    }

    public function testEnsureJsonIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Test', '--json' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Test', '--force' => true, '--json' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestJson.php'));
    }
}
