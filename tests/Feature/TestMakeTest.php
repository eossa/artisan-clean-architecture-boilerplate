<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class TestMakeTest extends TestCase
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
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Test.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Test.php'));
    }

    public function testEnsureDefaultIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Test.php'));
    }

    public function testEnsureUseCaseIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Test.php'));
    }

    public function testEnsureExistingUseCaseIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Test.php'));
    }

    public function testEnsureUseCaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--use-case' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Test.php'));
    }

    public function testEnsureControllerIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
    }

    public function testEnsureExistingControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
    }

    public function testEnsureControllerIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/Test.php'));
    }

    public function testEnsureNamespacedControllerIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
    }

    public function testEnsureExistingNamespacedControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
    }

    public function testEnsureNamespacedControllerIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/Example.php'));
    }
}
