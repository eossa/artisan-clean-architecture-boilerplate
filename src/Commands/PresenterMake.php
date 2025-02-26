<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class PresenterMake extends GeneratorCommand
{
    const CLI = 'cli';
    const HTTP = 'http';
    const JSON = 'json';

    const AVAILABLE_TYPES = [
        self::CLI,
        self::HTTP,
        self::JSON,
    ];

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
            '--http-presenter' => $this->isHttp(),
            '--cli-presenter' => $this->isCli(),
            // '--json-presenter' => $this->isJson(),
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
        if ($this->isJson()) {
            return __DIR__ . '/stubs/presenter.json.stub';
        }
        if ($this->isCli()) {
            return __DIR__ . '/stubs/presenter.cli.stub';
        }
        if ($this->isHttp()) {
            return __DIR__ . '/stubs/presenter.http.stub';
        }
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
        if ($this->isJson()) {
            $suffix = 'Json';
        }
        if ($this->isCli()) {
            $suffix = 'Cli';
        }
        if ($this->isHttp()) {
            $suffix = 'Http';
        }
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . "$suffix.php";
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

            ['type', InputArgument::OPTIONAL, 'The type of the presenter', 'http'],
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

    private function isHttp()
    {
        return $this->argument('type') === 'http';
    }

    private function isJson()
    {
        return $this->argument('type') === 'json';
    }

    private function isCli()
    {
        return $this->argument('type') === 'cli';
    }
}
