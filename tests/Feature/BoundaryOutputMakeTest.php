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
        return ['WasiCo\\ArtisanCleanArchitectureBoilerplate\\CommandServiceProvider'];
    }

    public function testEnsureBaseIsCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
    }

    public function testEnsureExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'EditExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/EditExample.php'));
        $this->assertOutputBoundaryContent('EditExample', 'Example');
        $this->artisan('make:boundary:output', ['name' => 'EditExample'])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/EditExample.php'));
    }

    public function testEnsureBaseIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'DeleteExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/DeleteExample.php'));
        $this->assertOutputBoundaryContent('DeleteExample', 'Example');
        $this->artisan('make:boundary:output', ['name' => 'DeleteExample', '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/DeleteExample.php'));
        $this->assertOutputBoundaryContent('DeleteExample', 'Example');
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/DeleteExample.php'));
    }

    public function testEnsureBaseAndDataAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'GetExamples', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/GetExamples.php'));
        $this->assertOutputBoundaryContent('GetExamples', 'Example');
        $this->assertFileExists(app_path('Domain/Data/Output/GetExamples.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/GetExamples.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/GetExamples.php'));
    }

    public function testEnsureBaseAndDataAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/CreateExample.php'));
    }

    public function testEnsureBaseAndDataAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/CreateExample.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
    }

    public function testEnsureBaseAndDefaultPresenterAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
    }

    public function testEnsureAllAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/CreateExample.php'));
    }

    public function testEnsureAllAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/CreateExample.php'));
    }

    public function testEnsureAllAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'CreateExample', '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example');
        $this->assertFileExists(app_path('Domain/Presenters/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseIsCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedExistingBaseIsNotCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample'])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseIsOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample'])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDataAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDataAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDataAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--data' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--data' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDefaultPresenterAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDefaultPresenterAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedBaseAndDefaultPresenterAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--presenter' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--presenter' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedAllAreCreated()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedAllAreNotOverwritten()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary already exists!')
            ->assertExitCode(1);
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
    }

    public function testEnsureNamespacedAllAreOverwrittenWhenAlreadyExists()
    {
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--all' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->artisan('make:boundary:output', ['name' => 'Admin/CreateExample', '--all' => true, '--force' => true])
            ->expectsOutput('Output Boundary created successfully.')
            ->expectsOutput('Presenter created successfully.')
            ->expectsOutput('Test created successfully.')
            ->expectsOutput('Output Data created successfully.')
            ->assertExitCode(0);
        $this->assertFileExists(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->assertOutputBoundaryContent('CreateExample', 'Example', '\\Admin');
        $this->assertFileExists(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->assertFileExists(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->assertFileExists(app_path('Domain/Data/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Boundaries/Output/Admin/CreateExample.php'));
        $this->app['files']->delete(app_path('Domain/Presenters/Admin/CreateExample.php'));
        $this->app['files']->delete(base_path('tests/Unit/Domain/Presenters/Admin/CreateExampleTest.php'));
        $this->app['files']->delete(app_path('Domain/Data/Output/Admin/CreateExample.php'));
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
