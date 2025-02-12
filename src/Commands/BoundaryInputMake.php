<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class BoundaryInputMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:boundary:input';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new input boundary interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Input Boundary';

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

        if ($this->option('all')) {
            $this->input->setOption('input-data', true);
            $this->input->setOption('use-case', true);
            $this->input->setOption('presenter', true);
            $this->input->setOption('output-data', true);
            $this->input->setOption('test', true);
        }

        if ($this->option('input-data')) {
            $this->createInputData();
        }

        if ($this->option('use-case')) {
            $this->createUseCase();
        }
        return 0;
    }

    /**
     * Create an input data for the input boundary.
     *
     * @return void
     */
    protected function createInputData()
    {
        $this->call('make:data:input', [
            'name' => $this->argument('name'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Create a use case for the input boundary.
     *
     * @return void
     */
    protected function createUseCase()
    {
        $this->call('make:use-case', [
            'name' => $this->argument('name'),
            '--presenter' => $this->option('presenter'),
            '--output-data' => $this->option('output-data'),
            '--test' => $this->option('test'),
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
        return __DIR__ . '/stubs/boundary.input.stub';
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
            ['DummyNamespace', 'DummyRootNamespace', 'DummyDataNamespace'],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getDataNamespace($name),
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
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Boundaries\Input';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a use case with a presenter for the input boundary'],

            ['input-data', 'i', InputOption::VALUE_NONE, 'Create a new input data for the input boundary'],

            ['use-case', 'u', InputOption::VALUE_NONE, 'Create a new use case for the input boundary'],

            ['presenter', 'p', InputOption::VALUE_NONE, 'Create a new presenter for the use case'],

            ['output-data', 'o', InputOption::VALUE_NONE, 'Create a new output data for the presenter'],

            ['test', 't', InputOption::VALUE_NONE, 'Generate a test for the use case'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the input boundary already exists.'],
        ];
    }
}
