<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class BoundaryInputMakeTest extends TestCase
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

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureExistingBaseIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->artisan('make:boundary:input', ['name' => $className])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->artisan('make:boundary:input', ['name' => $className, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndInputDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--input-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Input/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseAndOutputBoundaryAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseAndOutputBoundaryAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseAndOutputBoundaryAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--output-data' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryAndDefaultPresenterAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseUseCaseOutputBoundaryDefaultPresenterAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--use-case' => true, '--presenter' => true, '--force' => true, '--output-data' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Input/$className.php"));
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Input/$className.php"));
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--all' => true])
            ->expectsOutput('Input Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:input', ['name' => $className, '--all' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Input/$className.php"));
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:boundary:input', ['name' => $className, '--all' => true, '--force' => true])
            ->expectsOutput('Input Boundary created successfully.')
            ->expectsOutput('Input Data created successfully.')
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Input/$className.php"));
        $this->assertInputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Input/$className.php"));
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Input/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
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

    private function assertInputBoundaryContent(string $className, $viewModelClassName, string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/Boundaries/Input$fileNamespace/$className.php"),
            <<<PHP
<?php

namespace App\Domain\Boundaries\Input$namespace;

use App\Domain\Data\Input$namespace\\$className as Data;
use App\Domain\ViewModels$namespace\\$viewModelClassName as ViewModel;

interface $className
{
    public function do(Data \$data): ViewModel;
}

PHP
        );
    }
}
