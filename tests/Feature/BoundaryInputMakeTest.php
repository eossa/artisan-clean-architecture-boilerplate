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
        $this->artisan('make:boundary:input', ['name' => 'Example'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example'])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example'])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
    }

    public function testEnsureBaseAndInputDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--input-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Example.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseAndOutputBoundaryAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--output-data' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--use-case' => true, '--presenter' => true, '--force' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureAllAreNotOverwriten()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:input', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:boundary:input', ['name' => 'Example', '--all' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Input/Example.php'));
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Input/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }
}
