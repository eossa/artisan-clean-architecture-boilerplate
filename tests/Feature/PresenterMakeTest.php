<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

class PresenterMakeTest extends TestCase
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
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureDefaultIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureHttpIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureExistingHttpIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureHttpIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
    }

    public function testEnsureCliIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
    }

    public function testEnsureExistingCliIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
    }

    public function testEnsureCliIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
    }

    public function testEnsureJsonIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
    }

    public function testEnsureExistingJsonIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
    }

    public function testEnsureJsonIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
    }

    public function testEnsureAllIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureExistingAllIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureAllIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureAllHttpIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureExistingAllHttpIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureAllHttpIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'http', '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleHttp.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureAllCliIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureExistingAllCliIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureAllCliIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'cli', '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleCli.php'));
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureAllJsonIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureExistingAllJsonIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureAllJsonIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', 'type' => 'json', '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->app['files']->delete(app_path('Infrastructure/Presenters/ExampleJson.php'));
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }
}
