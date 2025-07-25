<?php

namespace Tests\Feature;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;

class BoundaryOutputMakeTest extends TestCase
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
    public function testEnsureBaseIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureExistingBaseIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->artisan('make:boundary:output', ['name' => $className])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->artisan('make:boundary:output', ['name' => $className, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDefaultPresenterAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDefaultPresenterAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureBaseAndDefaultPresenterAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureAllAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => $className, '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->artisan('make:boundary:output', ['name' => $className, '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName);
        $this->assertFileExists(app_path("Domain/Presenters/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseIsCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className"])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedExistingBaseIsNotCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className"])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className"])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseIsOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className"])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDataAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDataAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDataAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDefaultPresenterAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDefaultPresenterAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedBaseAndDefaultPresenterAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreCreated(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreNotOverwritten(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
    }

    /**
     * @dataProvider provider
     */
    public function testEnsureNamespacedAllAreOverwrittenWhenAlreadyExists(string $method)
    {
        $viewModelClassName = 'Example';
        $className = $method . $viewModelClassName . ($method === 'Get' ? 's' : '');
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->artisan('make:boundary:output', ['name' => "Admin/$className", '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->assertOutputBoundaryContent($className, $viewModelClassName, '\\Admin');
        $this->assertFileExists(app_path("Domain/Presenters/Admin/$className.php"));
        $this->assertFileExists(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->assertFileExists(app_path("Domain/Data/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Boundaries/Output/Admin/$className.php"));
        $this->app['files']->delete(app_path("Domain/Presenters/Admin/$className.php"));
        $this->app['files']->delete(base_path("tests/Unit/Domain/Presenters/Admin/{$className}Test.php"));
        $this->app['files']->delete(app_path("Domain/Data/Output/Admin/$className.php"));
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

    private function assertOutputBoundaryContent(string $className, $viewModelClassName, string $namespace = '')
    {
        $fileNamespace = str_replace('\\', '/', $namespace);
        $this->assertStringEqualsFile(
            app_path("Domain/Boundaries/Output$fileNamespace/$className.php"),
            <<<PHP
<?php

namespace App\Domain\Boundaries\Output$namespace;

use App\Domain\Data\Output$namespace\\$className as Data;
use App\Domain\ViewModels$namespace\\$viewModelClassName as ViewModel;

interface $className
{
    public function done(Data \$data): ViewModel;
}

PHP
        );
    }
}
