<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class PresenterMakeTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['WasiCo\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureExistingIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->artisan('make:presenter', ['name' => $className])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->artisan('make:presenter', ['name' => $className, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => "Admin/$className"])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName, '\\Admin');
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureExistingNamespacedIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => "Admin/$className"])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName, '\\Admin');
        $this->artisan('make:presenter', ['name' => "Admin/$className"])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => "Admin/$className"])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName, '\\Admin');
        $this->artisan('make:presenter', ['name' => "Admin/$className", '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName, '\\Admin');
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className, '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureExistingAllIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className, '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->artisan('make:presenter', ['name' => $className, '--all' => true])
            ->expectsOutput('Presenter already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:presenter', ['name' => $className, '--all' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->artisan('make:presenter', ['name' => $className, '--all' => true, '--force' => true])
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertPresenterContent($className, $viewModelClassName);
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
    }

    public function provider(): array
    {
        return [
            ['Create'],
            ['Edit'],
            ['Delete'],
            ['Get'],
        ];
    }

    private function assertPresenterContent(string $className, $viewModelClassName, string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/Presenters$fileNamespace/$className.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace App\Domain\Presenters$namespace;

use App\Domain\Boundaries\Output$namespace\\$className as OutputBoundary;
use App\Domain\Data\Output$namespace\\$className as Data;
use App\Domain\ViewModels$namespace\\$viewModelClassName as ViewModel;

class $className implements OutputBoundary
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
