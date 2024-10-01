<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class EntityMakeTest extends TestCase
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

    public function testEnsureEntityIsCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test'])
            ->expectsOutput('Entity created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
    }

    public function testEnsureExistingEntityIsNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test'])
            ->expectsOutput('Entity created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test'])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
    }

    public function testEnsureEntityIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test'])
            ->expectsOutput('Entity created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
    }

    public function testEnsureEntityRepositoryAndEloquentAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureExistingEntityRepositoryAndEloquentAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureEntityRepositoryAndEloquentAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
    }

    public function testEnsureEntityRepositoryEloquentAndMapperAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingEntityRepositoryEloquentAndMapperAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureEntityRepositoryEloquentAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--eloquent' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureEntityRepositoryAndMoloquentAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureExistingEntityRepositoryAndMoloquentAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureEntityRepositoryAndMoloquentAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
    }

    public function testEnsureEntityRepositoryMoloquentAndMapperAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingEntityRepositoryMoloquentAndMapperAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureEntityRepositoryMoloquentAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--moloquent' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Moloquent Repository created successfully.')
            ->expectsOutput('Moloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestMoloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureEntityRepositoryAndQueryBuilderAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureExistingEntityRepositoryAndQueryBuilderAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureEntityRepositoryAndQueryBuilderAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
    }

    public function testEnsureEntityRepositoryQueryBuilderAndMapperAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingEntityRepositoryQueryBuilderAndMapperAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureEntityRepositoryQueryBuilderAndMapperAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--mapper' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--query-builder' => true, '--mapper' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Query Builder Repository created successfully.')
            ->expectsOutput('Query Builder Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestQueryBuilder.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureExistingAllAreNotCreated()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Entity already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }

    public function testEnsureAllAreOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:entity', ['name' => 'Test', '--all' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->artisan('make:entity', ['name' => 'Test', '--all' => true, '--force' => true])
            ->expectsOutput('Entity created successfully.')
            ->expectsOutput('Repository created successfully.')
            ->expectsOutput('Eloquent Repository created successfully.')
            ->expectsOutput('Eloquent Mapper created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Entities/Test.php'));
        $this->assertFileExists(app_path('Domain/Repositories/Test.php'));
        $this->assertFileExists(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->assertFileExists(app_path('Infrastructure/Mappers/Test.php'));
        $this->app['files']->delete(app_path('Domain/Entities/Test.php'));
        $this->app['files']->delete(app_path('Domain/Repositories/Test.php'));
        $this->app['files']->delete(app_path('Infrastructure/Repositories/TestEloquent.php'));
        $this->app['files']->delete(app_path('Infrastructure/Mappers/Test.php'));
    }
}
