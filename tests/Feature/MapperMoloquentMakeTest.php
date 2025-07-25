<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class MapperMoloquentMakeTest extends TestCase
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
        return ['EOssa\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureBaseIsCreated()
    {
        $this->artisan('make:mapper:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:mapper:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:mapper:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Mapper already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:mapper:moloquent', ['name' => 'Test'])
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:mapper:moloquent', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
