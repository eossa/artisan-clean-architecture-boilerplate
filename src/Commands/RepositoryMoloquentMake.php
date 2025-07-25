<?php

namespace EOssa\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMoloquentMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository:moloquent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new moloquent repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Moloquent Repository';

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
            $this->input->setOption('mapper', true);
        }

        if ($this->option('mapper')) {
            $this->createMapper();
        }
        return 0;
    }

    /**
     * Create a mapper for the moloquent repository.
     *
     * @return void
     */
    protected function createMapper()
    {
        $this->call('make:mapper:moloquent', [
            'name' => $this->argument('name'),
            '--force' => $this->option('force'),
        ]);
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

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . 'Moloquent.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repository.moloquent.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Infrastructure\Repositories';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a use case for the repository'],

            ['mapper', 'm', InputOption::VALUE_NONE, 'Generate a mapper for the eloquent repository'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the repository already exists.'],
        ];
    }
}
