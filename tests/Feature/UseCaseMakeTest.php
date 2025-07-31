<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class UseCaseMakeTest extends TestCase
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
        return ['EOssa\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndOutputBoundaryAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndOutputBoundaryAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->artisan('make:use-case', ['name' => $className])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndOutputBoundaryAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->artisan('make:use-case', ['name' => $className, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:use-case', ['name' => $className, '--output-data' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:use-case', ['name' => $className, '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:use-case', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndDefaultPresenterAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:use-case', ['name' => $className, '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndTestAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndTestAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => $className, '--test' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseOutputBoundaryAndTestAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => $className, '--test' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => $className, '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
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
        $this->artisan('make:use-case', ['name' => $className, '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => $className, '--all' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
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
        $this->artisan('make:use-case', ['name' => $className, '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => $className, '--all' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/{$className}Test.php"));
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
    public function testEnsureNamespacedBaseAndOutputBoundaryAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className"])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndOutputBoundaryAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className"])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className"])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndOutputBoundaryAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className"])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--output-data' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--output-data' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--output-data' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndDefaultPresenterAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--presenter' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--test' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseOutputBoundaryAndTestAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--test' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--test' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Use Case already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->artisan('make:use-case', ['name' => "Admin/$className", '--all' => true, '--force' => true])
            ->expectsOutput('Use Case created successfully.')
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->expectsOutput('Test created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/UseCases/Admin/$className.php"));
        $this->assertUseCaseContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/UseCases/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/UseCases/Admin/{$className}Test.php"));
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

    private function assertUseCaseContent(string $className, $viewModelClassName, string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/UseCases$fileNamespace/$className.php"),
            <<<PHP
<?php

declare(strict_types=1);

namespace App\Domain\UseCases$namespace;

use App\Domain\Boundaries\Input$namespace\\$className as InputBoundary;
use App\Domain\Boundaries\Output$namespace\\$className as OutputBoundary;
use App\Domain\Data\Input$namespace\\$className as Data;
use App\Domain\Data\Output$namespace\\$className as OutputData;
use App\Domain\ViewModels$namespace\\$viewModelClassName as ViewModel;

class $className implements InputBoundary
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
