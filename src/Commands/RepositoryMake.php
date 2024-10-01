<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

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
            if (!$this->option('eloquent') && !$this->option('moloquent') && !$this->option('query-builder')) {
                $this->input->setOption('eloquent', true);
            }
            $this->input->setOption('mapper', true);
        }

        if ($this->option('eloquent')) {
            $this->createEloquentRepository();
        }

        if ($this->option('moloquent')) {
            $this->createMoloquentRepository();
        }

        if ($this->option('query-builder')) {
            $this->createQueryBuilderRepository();
        }
        return 0;
    }

    /**
     * Create an eloquent repository for the repository.
     *
     * @return void
     */
    protected function createEloquentRepository()
    {
        $this->call('make:repository:eloquent', [
            'name' => $this->argument('name'),
            '--mapper' => $this->option('mapper'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Create a moloquent repository for the repository.
     *
     * @return void
     */
    protected function createMoloquentRepository()
    {
        $this->call('make:repository:moloquent', [
            'name' => $this->argument('name'),
            '--mapper' => $this->option('mapper'),
            '--force' => $this->option('force'),
        ]);
    }

    /**
     * Create a query builder repository for the repository.
     *
     * @return void
     */
    protected function createQueryBuilderRepository()
    {
        $this->call('make:repository:query-builder', [
            'name' => $this->argument('name'),
            '--mapper' => $this->option('mapper'),
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
        return __DIR__ . '/stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Repositories';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a mapper and an eloquent repository implementation for the repository'],

            ['mapper', 'm', InputOption::VALUE_NONE, 'Generate a mapper for the repository implementation'],

            ['eloquent', 'E', InputOption::VALUE_NONE, 'Generate an eloquent repository implementation for the repository'],

            ['moloquent', 'M', InputOption::VALUE_NONE, 'Generate a moloquent repository implementation for the repository'],

            ['query-builder', 'Q', InputOption::VALUE_NONE, 'Generate a query builder repository implementation for the repository'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the repository already exists.'],
        ];
    }
}
