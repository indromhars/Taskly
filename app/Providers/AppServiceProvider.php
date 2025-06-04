<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\Project\CreateProject;
use App\Livewire\Project\EditProject;
use App\Livewire\Project\DeleteProject;
use App\Models\Team;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('create-project', CreateProject::class);
        Livewire::component('edit-project', EditProject::class);
        Livewire::component('delete-project', DeleteProject::class);
    }
}
