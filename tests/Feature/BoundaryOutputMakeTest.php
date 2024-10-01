<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class BoundaryOutputMakeTest extends TestCase
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

    public function testEnsureBaseIsCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:boundary:output', ['name' => 'Test'])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:boundary:output', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseAndDataAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:output', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }
}
