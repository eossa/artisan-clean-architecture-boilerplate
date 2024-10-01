<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class BoundaryInputMakeTest extends TestCase
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
        $this->artisan('make:boundary:input', ['name' => 'Test'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test'])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
    }

    public function testEnsureBaseAndInputDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--input-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--output-data' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--use-case' => true, '--presenter' => true, '--force' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->artisan('make:boundary:input', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Test.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Test.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Test.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Test.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/TestHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Test.php'));
    }
}
