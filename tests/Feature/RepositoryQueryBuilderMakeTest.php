<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class RepositoryQueryBuilderMakeTest extends TestCase
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
        $this->artisan('make:repository:query-builder', ['name' => 'Test'])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test'])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test'])
            ->expectsOutput('Query Builder Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test'])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureBaseAndMapperAreCreated()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseAndMapperAreNotCreated()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Query Builder Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--mapper' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--mapper' => true, '--force' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingAllAreNotCreated()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Query Builder Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository:query-builder', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
