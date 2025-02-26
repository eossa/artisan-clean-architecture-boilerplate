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
        $this->assertContent();
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureExistingDefaultIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->assertContent();
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
        $this->assertContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/ExampleTest.php'));
        $this->assertContent();
        $this->app['files']->delete(base_path('tests/Unit/ExampleTest.php'));
    }

    public function testEnsureNamespacedDefaultIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'User/Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/User/ExampleTest.php'));
        $this->assertContent('\\User');
        $this->app['files']->delete(base_path('tests/Unit/User/ExampleTest.php'));
    }

    public function testEnsureExistingNamespacedDefaultIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'User/Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/User/ExampleTest.php'));
        $this->assertContent('\\User');
        $this->artisan('make:phpunit', ['name' => 'User/Example'])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/User/ExampleTest.php'));
    }

    public function testEnsureNamespacedDefaultIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'User/Example'])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/User/ExampleTest.php'));
        $this->assertContent('\\User');
        $this->artisan('make:phpunit', ['name' => 'User/Example', '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/User/ExampleTest.php'));
        $this->assertContent('\\User');
        $this->app['files']->delete(base_path('tests/Unit/User/ExampleTest.php'));
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

    public function testEnsureDefaultPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureExistingDefaultPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureDefaultPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureNamespacedDefaultPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureExistingNamespacedDefaultPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureNamespacedDefaultPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureHttpPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureExistingHttpPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--http-presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureHttpPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--http-presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleHttpTest.php'));
    }

    public function testEnsureNamespacedHttpPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureExistingNamespacedHttpPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--http-presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureNamespacedHttpPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--http-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--http-presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
        $this->assertHttpPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleHttpTest.php'));
    }

    public function testEnsureCliPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->assertCliPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureExistingCliPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->assertCliPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--cli-presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureCliPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->assertCliPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--cli-presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
        $this->assertCliPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/ExampleCliTest.php'));
    }

    public function testEnsureNamespacedCliPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
        $this->assertCliPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
    }

    public function testEnsureExistingNamespacedCliPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
        $this->assertCliPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--cli-presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
    }

    public function testEnsureNamespacedCliPresenterIsOverwritenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--cli-presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
        $this->assertCliPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--cli-presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
        $this->assertCliPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Presenters/Admin/ExampleCliTest.php'));
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

    private function assertContent(string $namespace = '')
    {
        $filenamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit$filenamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit$namespace;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testEnsureIsComplete()
    {
        \$this->markTestIncomplete();
    }
}

PHP
        );
    }

    private function assertHttpPresenterContent(string $namespace = '')
    {
        $filenamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Infrastructure/Presenters$filenamespace/ExampleHttpTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Presenters$namespace;

use App\Domain\Data\Output$namespace\Example as Data;
use App\Infrastructure\Presenters$namespace\ExampleHttp as Presenter;
use PHPUnit\Framework\TestCase;

class ExampleHttpTest extends TestCase
{
    /**
     * @var Presenter
     */
    private \$presenter;

    protected function setUp()
    {
        \$this->presenter = new Presenter();
    }

    public function testEnsureReturnEmptySuccess()
    {
        \$viewModel = \$this->presenter->done(new Data());

        \$this->assertInstanceOf(Response::class, \$viewModel->render());
        \$this->assertEquals(
            '',
            \$viewModel->render()->getContent()
        );
    }
}

PHP
        );
    }

    private function assertCliPresenterContent(string $namespace = '')
    {
        $filenamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Infrastructure/Presenters$filenamespace/ExampleCliTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Presenters$namespace;

use App\Domain\Data\Output$namespace\Example as Data;
use App\Infrastructure\Presenters$namespace\ExampleCli as Presenter;
use Illuminate\Console\Command;
use PHPUnit\Framework\TestCase;

class ExampleCliTest extends TestCase
{
    /**
     * @var \Phrophecy\Prophecy\ObjectProphecy
     */
    private \$command;

    /**
     * @var Presenter
     */
    private \$presenter;

    protected function setUp()
    {
        \$this->command = \$this->prophesize(Command::class);
        \$this->presenter = new Presenter();
    }

    public function testEnsurePrintDone()
    {
        \$viewModel = \$this->presenter->made(new Data());

        \$this->assertSame(0, \$viewModel->render(\$this->command->reveal()));
        \$this->command->info('Done')->shouldHaveBeenCalled();
    }
}

PHP
        );
    }
}
