<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class RepositoryMoloquentMakeTest extends TestCase
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
        $this->artisan('make:repository:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureBaseAndMapperAreCreated()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseAndMapperAreNotCreated()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Moloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--mapper' => true, '--force' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingAllAreNotCreated()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Moloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:moloquent', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
