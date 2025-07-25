<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class TestMakeTest extends TestCase
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

    public function testEnsureDefaultIsOverwrittenWhenAlreadyExists()
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

    public function testEnsureNamespacedDefaultIsOverwrittenWhenAlreadyExists()
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

    public function testEnsureUseCaseIsOverwrittenWhenAlreadyExists()
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

    public function testEnsureNamespacedUseCaseIsOverwrittenWhenAlreadyExists()
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
        $this->assertControllerContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureExistingControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControllerContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureControllerIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControllerContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
        $this->assertControllerContent();
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/ExampleTest.php'));
    }

    public function testEnsureNamespacedControllerIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControllerContent('\\V1');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    public function testEnsureExistingNamespacedControllerIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControllerContent('\\V1');
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    public function testEnsureNamespacedControllerIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControllerContent('\\V1');
        $this->artisan('make:phpunit', ['name' => 'V1/Example', '--controller' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
        $this->assertControllerContent('\\V1');
        $this->app['files']->delete(base_path('tests/Unit/Infrastructure/Controllers/V1/ExampleTest.php'));
    }

    public function testEnsurePresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    public function testEnsureExistingPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    public function testEnsurePresenterIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertPresenterContent();
        $this->artisan('make:phpunit', ['name' => 'Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
        $this->assertPresenterContent();
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/ExampleTest.php'));
    }

    public function testEnsureNamespacedPresenterIsCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
    }

    public function testEnsureExistingNamespacedPresenterIsNotCreated()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
    }

    public function testEnsureNamespacedPresenterIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertPresenterContent('\\Admin');
        $this->artisan('make:phpunit', ['name' => 'Admin/Example', '--presenter' => true, '--force' => true])
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
        $this->assertPresenterContent('\\Admin');
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/ExampleTest.php'));
    }

    private function assertControllerContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Infrastructure/Controllers$fileNamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Controllers$namespace;

use App\Domain\Boundaries\Input$namespace\Example as InputBoundary;
use App\Domain\Data\Input$namespace\Example as Data;
use App\Domain\ViewModel;
use App\Http\Controllers$namespace\ExampleController as Controller;
use App\Http\Requests$namespace\Example as Request;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Builders\RequestBuilder;

class ExampleTest extends TestCase
{
    /**
     * @var Controller
     */
    private \$controller;

    /**
     * @var ObjectProphecy|InputBoundary
     */
    private \$useCase;

    /**
     * @var ObjectProphecy|ViewModel
     */
    private \$viewModel;

    public function testEnsureUseCaseIsCalled()
    {
        \$this->useCase->do(new Data())->willReturn(\$this->viewModel->reveal());
        \$this->viewModel->render()->willReturn('OK');
        \$request = RequestBuilder::aRequest()
            ->withHeader('HTTP_CONTENT_TYPE', 'application/json')
            ->withBodyJsonAsArray([
                'foo' => 'bar',
            ])
            ->build();

        \$response = \$this->controller->__invoke(Request::createFromBase(\$request));

        \$this->assertNotNull(\$response);
        \$this->assertEquals('OK', \$response);
        \$this->useCase->do(new Data())->shouldHaveBeenCalled();
        \$this->viewModel->render()->shouldHaveBeenCalled();
    }

    protected function setUp()
    {
        \$this->useCase = \$this->prophesize(InputBoundary::class);
        \$this->viewModel = \$this->prophesize(ViewModel::class);
        \$this->controller = new Controller(\$this->useCase->reveal());
    }
}

PHP
        );
    }

    private function assertUseCaseContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Domain/UseCases$fileNamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\UseCases$namespace;

use App\Domain\Boundaries\Output$namespace\Example as OutputBoundary;
use App\Domain\Data\Input$namespace\Example as InputData;
use App\Domain\Data\Output$namespace\Example as OutputData;
use App\Domain\UseCases$namespace\Example as UseCase;
use App\Domain\ViewModels$namespace\Example as ViewModel;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class ExampleTest extends TestCase
{
    /**
     * @var ObjectProphecy|OutputBoundary
     */
    private \$output;

    /**
     * @var UseCase
     */
    private \$useCase;

    public function testDo()
    {
        \$this->output->done(new OutputData())->willReturn(new ViewModel());

        \$viewModel = \$this->useCase->do(new InputData());

        \$this->assertInstanceOf(ViewModel::class, \$viewModel);
        \$this->output->done(new OutputData())->shouldHaveBeenCalled();
    }

    protected function setUp()
    {
        \$this->output = \$this->prophesize(OutputBoundary::class);
        \$this->useCase = new UseCase(\$this->output->reveal());
    }
}

PHP
        );
    }

    private function assertContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit$fileNamespace/ExampleTest.php"),
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

    private function assertPresenterContent(string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            base_path("tests/Unit/Domain/Presenters$fileNamespace/ExampleTest.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Presenters$namespace;

use App\Domain\Data\Output$namespace\Example as Data;
use App\Domain\Presenters$namespace\Example as Presenter;
use App\Domain\ViewModels$namespace\Example as ViewModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ExampleTest extends TestCase
{
    /**
     * @var Presenter
     */
    private \$presenter;

    public function testEnsureReturnEmptySuccess()
    {
        \$viewModel = \$this->presenter->done(new Data());

        \$this->assertInstanceOf(ViewModel::class, \$viewModel);
    }

    protected function setUp()
    {
        \$this->presenter = new Presenter();
    }
}

PHP
        );
    }
}
