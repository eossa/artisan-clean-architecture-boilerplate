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
        $this->assertFileExists(base_path('tests/Feature/Test.php'));
        $this->app['files']->delete(base_path('tests/Feature/Test.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Feature/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test'])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Feature/Test.php'));
    }

    public function testEnsureUnitIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--unit' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->app['files']->delete(base_path('tests/Unit/Test.php'));
    }

    public function testEnsureExistingUnitIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Test', '--unit' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Test.php'));
        $this->artisan('make:phpunit', ['name' => 'Test', '--unit' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Test.php'));
    }
}
