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
        $this->artisan('make:boundary:output', ['name' => 'Example'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:boundary:output', ['name' => 'Example'])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:boundary:output', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseAndDataAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureAllAreNotOverwriten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:output', ['name' => 'Example', '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }
}
