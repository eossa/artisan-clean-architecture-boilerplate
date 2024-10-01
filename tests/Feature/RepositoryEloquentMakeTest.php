<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class RepositoryEloquentMakeTest extends TestCase
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
        $this->artisan('make:repository:eloquent', ['name' => 'Test'])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test'])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test'])
            ->expectsOutput('Eloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test'])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureBaseAndMapperAreCreated()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseAndMapperAreNotCreated()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Eloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--mapper' => true, '--force' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingAllAreNotCreated()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Eloquent Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:eloquent', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
