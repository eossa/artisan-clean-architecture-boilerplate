<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class PresenterMakeTest extends TestCase
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
        return ['WasiCo\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureExistingIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->artisan('make:presenter', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
    }

    public function testEnsureNamespacedIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Admin/Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertPresenterContent('\\Admin');
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureExistingNamespacedIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Admin/Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertPresenterContent('\\Admin');
        $this->artisan('make:presenter', ['name' => 'Admin/Example'])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureNamespacedIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Admin/Example'])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertPresenterContent('\\Admin');
        $this->artisan('make:presenter', ['name' => 'Admin/Example', '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Admin/Example.php'));
        $this->assertPresenterContent('\\Admin');
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/Example.php'));
    }

    public function testEnsureAllIsCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    public function testEnsureExistingAllIsNotCreated()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    public function testEnsureAllIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->artisan('make:presenter', ['name' => 'Example', '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Presenters/Example.php'));
        $this->assertPresenterContent();
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Example.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    private function assertPresenterContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/Presenters$fileNamespace/Example.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace App\Domain\Presenters$namespace;

use App\Domain\Boundaries\Output$namespace\Example as OutputBoundary;
use App\Domain\Data\Output$namespace\Example as Data;
use App\Domain\ViewModels$namespace\Example as ViewModel;

class Example implements OutputBoundary
{
    public function done(Data \$data): ViewModel
    {
        return new ViewModel();
    }
}

PHP
        );
    }
}
