<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class EntityMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new entity class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Entity';

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

        if ($this->option('eloquent') || $this->option('moloquent') || $this->option('query-builder')) {
            $this->createRepository();
        }
        return 0;
    }

    /**
     * Create a repository for the entity.
     *
     * @return void
     */
    protected function createRepository()
    {
        $this->call('make:repository', [
            'name' => $this->argument('name'),
            '--mapper' => $this->option('mapper'),
            '--eloquent' => $this->option('eloquent'),
            '--moloquent' => $this->option('moloquent'),
            '--query-builder' => $this->option('query-builder'),
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
        return __DIR__ . '/stubs/entity.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Entities';
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

            ['eloquent', 'E', InputOption::VALUE_NONE, 'Generate an eloquent repository implementation for the entity'],

            ['moloquent', 'M', InputOption::VALUE_NONE, 'Generate a moloquent repository implementation for the entity'],

            ['query-builder', 'Q', InputOption::VALUE_NONE, 'Generate a query builder repository implementation for the entity'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the entity already exists.'],
        ];
    }
}
