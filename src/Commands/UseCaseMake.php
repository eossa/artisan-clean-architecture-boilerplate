<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class UseCaseMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:use-case';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new use case class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Use Case';

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
            $this->input->setOption('presenter', true);
            $this->input->setOption('output-data', true);
            $this->input->setOption('test', true);
        }

        $this->createOutputBoundary();

        if ($this->option('test')) {
            $this->createTest();
        }
        return 0;
    }

    /**
     * Create an output boundary for the repository.
     *
     * @return void
     */
    protected function createOutputBoundary()
    {
        $this->call('make:boundary:output', [
            'name' => $this->argument('name'),
            '--presenter' => $this->option('presenter'),
            '--data' => $this->option('output-data'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Create a test for the repository.
     *
     * @return void
     */
    protected function createTest()
    {
        $this->call('make:phpunit', [
            'name' => $this->argument('name'),
            '--use-case' => true,
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
        return __DIR__ . '/stubs/use_case.stub';
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
                'DummyOutputDataNamespace'
            ],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getInputBoundaryNamespace($name),
                $this->getOutputBoundaryNamespace($name),
                $this->getInputDataNamespace($name),
                $this->getOutputDataNamespace($name),
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
        return str_replace('UseCases', 'Boundaries\Input', $this->getNamespace($name));
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
        return str_replace('UseCases', 'Boundaries\Output', $this->getNamespace($name));
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
        return str_replace('UseCases', 'Data\Input', $this->getNamespace($name));
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
        return str_replace('UseCases', 'Data\Output', $this->getNamespace($name));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\UseCases';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a presenter for the use case'],

            ['presenter', 'p', InputOption::VALUE_NONE, 'Generate a presenter for the use case'],

            ['output-data', 'o', InputOption::VALUE_NONE, 'Generate an output data for the use case'],

            ['test', 't', InputOption::VALUE_NONE, 'Generate a test for the use case'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the use case already exists.'],
        ];
    }
}
