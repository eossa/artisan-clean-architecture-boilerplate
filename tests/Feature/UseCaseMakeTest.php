<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class UseCaseMakeTest extends TestCase
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

    public function testEnsureBaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Test'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseAndOutputBoundaryAreNotOverwriten()
    {
        $this->artisan('make:use-case', ['name' => 'Test'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test'])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseAndOutputBoundaryAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Test'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreNotOverwriten()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--output-data' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreNotOverwriten()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreNotOverwriten()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:use-case', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }
}
