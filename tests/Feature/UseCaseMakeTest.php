<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class UseCaseMakeTest extends TestCase
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
        return ['WasiCo\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureBaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseAndOutputBoundaryAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example'])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseAndOutputBoundaryAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDataAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureBaseOutputBoundaryAndTestAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureBaseOutputBoundaryAndTestAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureBaseOutputBoundaryAndTestAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureAllAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureAllAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--all' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }
}
