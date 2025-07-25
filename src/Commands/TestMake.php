<?php

namespace EOssa\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class TestMake extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:phpunit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return 1;
        }
        return 0;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path('tests') . str_replace('\\', '/', $name) . "Test.php";
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            [
                'DummyNamespace',
                'DummyRootNamespace',
                'DummyInputBoundaryNamespace',
                'DummyOutputBoundaryNamespace',
                'DummyInputDataNamespace',
                'DummyOutputDataNamespace',
                'DummyUseCaseNamespace',
                'DummyControllerNamespace',
                'DummyRequestNamespace',
                'DummyPresenterNamespace',
                'DummyViewModelNamespace',
            ],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getInputBoundaryNamespace($name),
                $this->getOutputBoundaryNamespace($name),
                $this->getInputDataNamespace($name),
                $this->getOutputDataNamespace($name),
                $this->getUseCaseNamespace($name),
                $this->getControllerNamespace($name),
                $this->getRequestNamespace($name),
                $this->getPresenterNamespace($name),
                $this->getViewModelNamespace($name),
            ],
            $stub
        );
        return $this;
    }

    /**
     * Get the input boundary namespace for the class.
     */
    protected function getInputBoundaryNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Boundaries\Input');
    }

    /**
     * Get the output boundary namespace for the class.
     */
    protected function getOutputBoundaryNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Boundaries\Output');
    }

    /**
     * Get the input data namespace for the class.
     */
    protected function getInputDataNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Data\Input');
    }

    /**
     * Get the output data namespace for the class.
     */
    protected function getOutputDataNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Data\Output');
    }

    /**
     * Get the use case namespace for the class.
     */
    protected function getUseCaseNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\UseCases');
    }

    /**
     * Get the controller namespace for the class.
     */
    protected function getControllerNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Http\Controllers', false);
    }

    /**
     * Get the request namespace for the class.
     */
    protected function getRequestNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Http\Requests', false);
    }

    /**
     * Get the presenter namespace for the class.
     */
    protected function getPresenterNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Presenters');
    }

    /**
     * Get the view model namespace for the class.
     */
    protected function getViewModelNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\ViewModels');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Unit' . $this->getOptionNamespace();
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Tests';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('controller')) {
            return __DIR__ . '/stubs/unit_test.controller.stub';
        }
        if ($this->option('presenter')) {
            return __DIR__ . '/stubs/unit_test.presenter.stub';
        }
        if ($this->option('use-case')) {
            return __DIR__ . '/stubs/unit_test.use_case.stub';
        }
        return __DIR__ . '/stubs/unit_test.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['controller', 'c', InputOption::VALUE_NONE, 'Generate a controller test'],

            ['presenter', 'p', InputOption::VALUE_NONE, 'Generate a presenter test'],

            ['use-case', 'u', InputOption::VALUE_NONE, 'Generate a use case test'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the test already exists.'],
        ];
    }

    private function isDefault(): bool
    {
        return !$this->option('use-case')
            && !$this->option('controller')
            && !$this->option('presenter');
    }

    private function getAppNamespace(string $name, bool $isDomain): string
    {
        return str_replace(
            $this->rootNamespace() . '\Unit',
            trim($this->laravel->getNamespace(), '\\') . ($isDomain ? '\Domain' : ''),
            $name
        );
    }

    private function getOptionNamespace(): string
    {
        if ($this->option('controller')) {
            return '\Infrastructure\Controllers';
        }
        if ($this->option('presenter')) {
            return '\Domain\Presenters';
        }
        if ($this->option('use-case')) {
            return '\Domain\UseCases';
        }
        return '';
    }

    private function getSpecificNamespace(string $name, string $namespace, bool $isDomain = true): string
    {
        if ($this->isDefault()) {
            return $this->getNamespace($name);
        }
        return str_replace(
            $this->getOptionNamespace(),
            $namespace,
            $this->getNamespace($this->getAppNamespace($name, $isDomain))
        );
    }
}
