<?php

declare(strict_types=1);

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
        $this->artisan('make:phpunit', ['name' => 'Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->artisan('make:phpunit', ['name' => 'Example'])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureDefaultIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->artisan('make:phpunit', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureUseCaseIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->assertUseCaseContent();
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureExistingUseCaseIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->assertUseCaseContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureUseCaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->assertUseCaseContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--use-case' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
        $this->assertUseCaseContent();
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/ExampleTest.php'));
    }

    public function testEnsureNamespacedUseCaseIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureExistingNamespacedUseCaseIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--use-case' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedUseCaseIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--use-case' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--use-case' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
        $this->assertUseCaseContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Domain/UseCases/Admin/ExampleTest.php'));
    }

    public function testEnsureControllerIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControlllerContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureExistingControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControlllerContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureControllerIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControlllerContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControlllerContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureNamespacedControllerIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControlllerContent('\\V1');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    public function testEnsureExistingNamespacedControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControlllerContent('\\V1');
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    public function testEnsureNamespacedControllerIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControlllerContent('\\V1');
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControlllerContent('\\V1');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    private function assertControlllerContent(string $namespace = '')
    {
        $filenamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Infrastructure/Controllers$filenamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Controllers$namespace;

use App\Domain\Boundaries\Input\Example as InputBoundary;
use App\Domain\Data\Input\Example as Data;
use App\Domain\ViewModel;
use App\Http\Controllers$namespace\ExampleController as Controller;
use App\Http\Requests$namespace\Example as Request;
use PHPUnit\Framework\TestCase;
use Tests\Builders\RequestBuilder;

class ExampleTest extends TestCase
{
    public function testEnsureUseCaseIsCalled()
    {
        \$useCase = \$this->prophesize(InputBoundary::class);
        \$viewModel = \$this->prophesize(ViewModel::class);
        \$controller = new Controller(\$useCase->reveal());
        \$useCase->do(new Data())->willReturn(\$viewModel->reveal());
        \$viewModel->render()->willReturn('OK');
        \$request = RequestBuilder::aRequest()
            ->withHeader('HTTP_CONTENT_TYPE', 'application/json')
            ->withBodyJsonAsArray([
                'foo' => 'bar',
            ])
            ->build();

        \$response = \$controller->__invoke(Request::createFromBase(\$request));

        \$this->assertNotNull(\$response);
        \$this->assertEquals('OK', \$response);
        \$useCase->do(new Data())->shouldHaveBeenCalled();
        \$viewModel->render()->shouldHaveBeenCalled();
    }
}

PHP
        );
    }

    private function assertUseCaseContent(string $namespace = '')
    {
        $filenamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Domain/UseCases$filenamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\UseCases$namespace;

use App\Domain\Boundaries\Output$namespace\Example as OutputBoundary;
use App\Domain\Data\Input$namespace\Example as InputData;
use App\Domain\Data\Output$namespace\Example as OutputData;
use App\Domain\UseCases$namespace\Example as UseCase;
use App\Domain\ViewModel;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testEnsureIsDone()
    {
        \$viewModel = \$this->prophesize(ViewModel::class);
        \$output = \$this->prophesize(OutputBoundary::class);
        \$output->done(new OutputData())->willReturn(\$viewModel->reveal());
        \$useCase = new UseCase(\$output->reveal());

        \$useCase->do(new InputData());

        \$output->done(new OutputData())->shouldHaveBeenCalled();
    }
}

PHP
        );
    }
}
