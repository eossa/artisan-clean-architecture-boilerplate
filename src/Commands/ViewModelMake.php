<?php

namespace EOssa\ArtisanCleanArchitectureBoilerplate\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ViewModelMake extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:view-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'ViewModel';

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
        return __DIR__ . '/stubs/view_model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\ViewModels';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the view model already exists.'],
        ];
    }
}
