<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class RepositoryMakeTest extends TestCase
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
        $this->artisan('make:repository', ['name' => 'Test'])
            ->expectsOutput('Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test'])
            ->expectsOutput('Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test'])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
    }

    public function testEnsureBaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test'])
            ->expectsOutput('Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
    }

    public function testEnsureBaseAndEloquentAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureExistingBaseAndEloquentAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureBaseAndEloquentAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureBaseEloquentAndMapperAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseEloquentAndMapperAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseEloquentAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--eloquent' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseAndMoloquentAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureExistingBaseAndMoloquentAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureBaseAndMoloquentAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureBaseMoloquentAndMapperAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseMoloquentAndMapperAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseMoloquentAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--moloquent' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseAndQueryBuilderAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureExistingBaseAndQueryBuilderAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureBaseAndQueryBuilderAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureBaseQueryBuilderAndMapperAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingBaseQueryBuilderAndMapperAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureBaseQueryBuilderAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--query-builder' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingAllAreNotCreated()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Repository already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:repository', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:repository', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
