<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;

class PresenterMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:presenter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new presenter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Presenter';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return 1;
        }
        return 0;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('json')) {
            return __DIR__ . '/stubs/presenter.json.stub';
        }
        if ($this->option('cli')) {
            return __DIR__ . '/stubs/presenter.cli.stub';
        }
        return __DIR__ . '/stubs/presenter.http.stub';
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
            ['DummyNamespace', 'DummyRootNamespace', 'DummyBoundaryNamespace', 'DummyDataNamespace'],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getBoundaryNamespace($name),
                $this->getDataNamespace($name),
            ],
            $stub
        );

        return $this;
    }

    /**
     * Get the boundary namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getBoundaryNamespace(string $name): string
    {
        return str_replace('Infrastructure\Presenters', 'Domain\Boundaries\Output', $this->getNamespace($name));
    }

    /**
     * Get the data namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getDataNamespace(string $name): string
    {
        return str_replace('Infrastructure\Presenters', 'Domain\Data\Output', $this->getNamespace($name));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Infrastructure\Presenters';
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
        if ($this->option('json')) {
            $suffix = 'Json';
        } elseif ($this->option('cli')) {
            $suffix = 'Cli';
        } else {
            $suffix = 'Http';
        }
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . "$suffix.php";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['http', 'H', InputOption::VALUE_NONE, 'Generate an HTTP presenter'],

            ['json', 'j', InputOption::VALUE_NONE, 'Generate a JSON presenter'],

            ['cli', 'c', InputOption::VALUE_NONE, 'Generate a CLI presenter'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the presenter already exists.'],
        ];
    }
}
