<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('presenter') && !$this->option('http-presenter') && !$this->option('cli-presenter')) {
            $this->input->setOption('http-presenter', true);
        }
        if (parent::handle() === false && ! $this->option('force')) {
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
        $suffix = '';
        if ($this->option('http-presenter')) {
            $suffix = 'Http';
        }
        if ($this->option('cli-presenter')) {
            $suffix = 'Cli';
        }

        return base_path('tests') . str_replace('\\', '/', $name) . "{$suffix}Test.php";
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
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
            ],
            $stub
        );
        return $this;
    }

    /**
     * Get the input boundary namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getInputBoundaryNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Boundaries\Input');
    }

    /**
     * Get the output boundary namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getOutputBoundaryNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Boundaries\Output');
    }

    /**
     * Get the input data namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getInputDataNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Data\Input');
    }

    /**
     * Get the output data namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getOutputDataNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Data\Output');
    }

    /**
     * Get the use case namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getUseCaseNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\UseCases');
    }

    /**
     * Get the controller namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getControllerNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Http\Controllers', false);
    }

    /**
     * Get the request namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getRequestNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Http\Requests', false);
    }

    /**
     * Get the presenter namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPresenterNamespace(string $name): string
    {
        return $this->getSpecificNamespace($name, '\Infrastructure\Presenters', false);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
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
        if ($this->option('cli-presenter')) {
            return __DIR__ . '/stubs/unit_test.cli_presenter.stub';
        }
        if ($this->option('http-presenter')) {
            return __DIR__ . '/stubs/unit_test.http_presenter.stub';
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

            ['cli-presenter', 'C', InputOption::VALUE_NONE, 'Generate a CLI presenter test'],

            ['http-presenter', 'H', InputOption::VALUE_NONE, 'Generate an HTTP presenter test'],

            ['presenter', 'p', InputOption::VALUE_NONE, 'Generate a presenter test'],

            ['use-case', 'u', InputOption::VALUE_NONE, 'Generate a use case test'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the test already exists.'],
        ];
    }

    private function isDefault(): bool
    {
        return !$this->option('use-case')
            && !$this->option('controller')
            && !$this->option('cli-presenter')
            && !$this->option('http-presenter');
    }

    private function getAppNamespace(string $name, bool $isDomain): string
    {
        if ($isDomain) {
            $name = preg_replace('/\\\\v[0-9]+\\\\/i', '\\', $name);
        }
        return str_replace(
            $this->rootNamespace() . '\Unit',
            trim($this->laravel->getNamespace(), '\\') . ($isDomain ? '\Domain' : ''),
            $name
        );
    }

    private function getOptionNamespace()
    {
        if ($this->option('controller')) {
            return '\Infrastructure\Controllers';
        }
        if ($this->option('cli-presenter') || $this->option('http-presenter')) {
            return '\Infrastructure\Presenters';
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
