<?php

namespace EOssa\ArtisanCleanArchitectureBoilerplate;

use Illuminate\Support\ServiceProvider;
use EOssa\ArtisanCleanArchitectureBoilerplate\Commands\{
    BoundaryInputMake,
    BoundaryOutputMake,
    DataInputMake,
    DataOutputMake,
    EntityMake,
    MapperEloquentMake,
    MapperMoloquentMake,
    MapperQueryBuilderMake,
    PresenterMake,
    RepositoryEloquentMake,
    RepositoryMake,
    RepositoryMoloquentMake,
    RepositoryQueryBuilderMake,
    TestMake,
    UseCaseMake,
    ViewModelMake
};

class CommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BoundaryInputMake::class,
                BoundaryOutputMake::class,
                DataInputMake::class,
                DataOutputMake::class,
                EntityMake::class,
                MapperEloquentMake::class,
                MapperMoloquentMake::class,
                MapperQueryBuilderMake::class,
                PresenterMake::class,
                RepositoryEloquentMake::class,
                RepositoryMake::class,
                RepositoryMoloquentMake::class,
                RepositoryQueryBuilderMake::class,
                TestMake::class,
                UseCaseMake::class,
                ViewModelMake::class,
            ]);
        }
    }
}
