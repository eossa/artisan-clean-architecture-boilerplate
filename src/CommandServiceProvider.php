<?php

namespace WasiCo\ArtisanCleanArchitectureBoilerplate;

use Illuminate\Support\ServiceProvider;
use WasiCo\ArtisanCleanArchitectureBoilerplate\Commands\{
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
    UseCaseMake
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
            ]);
        }
    }
}
