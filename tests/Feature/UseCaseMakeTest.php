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
        return ['EOssa\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureBaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Example', '--test' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Example.php'));
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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
        $this->assertUseCaseContent();
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

    public function testEnsureNamespacedBaseAndOutputBoundaryAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseAndOutputBoundaryAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example'])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseAndOutputBoundaryAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example'])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--output-data' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--test' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--test' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedAllAreCreated()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedAllAreNotOverwritten()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--all' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedAllAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->artisan('make:use-case', ['name' => 'Admin/Example', '--all' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/UseCases/Admin/Example.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/UseCases/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/Example.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    private function assertUseCaseContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/UseCases$fileNamespace/Example.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace App\Domain\UseCases$namespace;

use App\Domain\Boundaries\Input$namespace\Example as InputBoundary;
use App\Domain\Boundaries\Output$namespace\Example as OutputBoundary;
use App\Domain\Data\Input$namespace\Example as Data;
use App\Domain\Data\Output$namespace\Example as OutputData;
use App\Domain\ViewModels$namespace\Example as ViewModel;

class Example implements InputBoundary
{
    private \$output;

    public function __construct(OutputBoundary \$output)
    {
        \$this->output = \$output;
    }

    public function do(Data \$data): ViewModel
    {
        return \$this->output->done(new OutputData());
    }
}

PHP
        );
    }
}
