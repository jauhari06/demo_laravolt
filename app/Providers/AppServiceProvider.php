<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\Table\NewsTable;
use App\Http\Livewire\Table\TopicTable;
use App\Http\Livewire\Table\ActivityTable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

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
        Livewire::component('table.news-table', NewsTable::class);
        Livewire::component('table.topic-table', TopicTable::class);
        Livewire::component('table.activity-table', ActivityTable::class);
    }
}
