<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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

    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return 1;
        }

        if ($this->option('all')) {
            $this->input->setOption('test', true);
        }

        if ($this->option('test')) {
            $this->createTest();
        }
        return 0;
    }

    /**
     * Create a test for the presenter.
     *
     * @return void
     */
    protected function createTest()
    {
        $this->call('make:phpunit', [
            'name' => $this->argument('name'),
            '--presenter' => true,
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
        return __DIR__ . '/stubs/presenter.stub';
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
                'DummyBoundaryNamespace',
                'DummyDataNamespace',
                'DummyViewModelNamespace',
            ],
            [
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->getBoundaryNamespace($name),
                $this->getDataNamespace($name),
                $this->getViewModelNamespace($name),
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
        return str_replace('Domain\Presenters', 'Domain\Boundaries\Output', $this->getNamespace($name));
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
        return str_replace('Domain\Presenters', 'Domain\Data\Output', $this->getNamespace($name));
    }

    /**
     * Get the view model namespace for the class.
     */
    protected function getViewModelNamespace(string $name): string
    {
        return str_replace('Domain\Presenters', 'Domain\ViewModels', $this->getNamespace($name));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Presenters';
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
            ['all', 'a', InputOption::VALUE_NONE, 'Generate all options for the output boundary'],

            ['test', 't', InputOption::VALUE_NONE, 'Generate a test for the presenter'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the presenter already exists.'],
        ];
    }
}
