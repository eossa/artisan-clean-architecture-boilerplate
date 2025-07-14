<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class BoundaryOutputMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:boundary:output';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new output boundary interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Output Boundary';

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return 1;
        }

        if ($this->option('all')) {
            $this->input->setOption('presenter', true);
            $this->input->setOption('data', true);
            $this->input->setOption('test', true);
        }

        if ($this->option('presenter')) {
            $this->createPresenter();
        }
        if ($this->option('data')) {
            $this->createData();
        }
        return 0;
    }

    /**
     * Create a presenter for the output boundary.
     *
     * @return void
     */
    protected function createPresenter()
    {
        $this->call('make:presenter', [
            'name' => $this->argument('name'),
            '--test' => $this->option('test'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Create a data for the output boundary.
     *
     * @return void
     */
    protected function createData()
    {
        $this->call('make:data:output', [
            'name' => $this->argument('name'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/boundary.output.stub';
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
            ['DummyNamespace', 'DummyRootNamespace', 'DummyDataNamespace', 'DummyViewModelNamespace'],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getDataNamespace($name),
                $this->getViewModelNamespace($name),
            ],
            $stub
        );
        return $this;
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
        return str_replace('Boundaries', 'Data', $this->getNamespace($name));
    }

    /**
     * Get the view model namespace for the class.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getViewModelNamespace(string $name): string
    {
        return str_replace('Boundaries\Output', 'ViewModels', $this->getNamespace($name));
    }

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        foreach (['Get', 'Edit', 'Create', 'Delete'] as $word) {
            $class = Str::replaceFirst($word, '', $class);
        }
        $class = Str::singular($class);
        return str_replace('DummyViewModelClass', $class, $stub);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Boundaries\Output';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a presenter for the output boundary'],

            ['presenter', 'p', InputOption::VALUE_NONE, 'Create a new presenter for the output boundary'],

            ['data', 'd', InputOption::VALUE_NONE, 'Create a new data for the output boundary'],

            ['test', 't', InputOption::VALUE_NONE, 'Generate a test for the presenter'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the output boundary already exists.'],
        ];
    }
}
