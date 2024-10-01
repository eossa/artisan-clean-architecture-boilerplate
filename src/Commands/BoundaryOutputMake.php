<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
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
            $this->input->setOption('data', true);
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
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Boundaries\Output';
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

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the output boundary already exists.'],
        ];
    }
}
