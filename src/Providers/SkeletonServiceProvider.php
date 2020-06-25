<?php

namespace Bishopm\Skeleton\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Form;

class SkeletonServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Bishopm\Skeleton\Console\InstallSkeletonCommand'
    ];

    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(255);
        require __DIR__.'/../Http/api.routes.php';
        require __DIR__.'/../Http/web.routes.php';
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'skeleton');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->publishes([__DIR__.'/../Assets' => public_path('vendor/bishopm')], 'public');
        config(['auth.providers.users.model'=>'Bishopm\Skeleton\Models\User']);
        config(['queue.default'=>'database']);
        Form::component('bsText', 'skeleton::components.text', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'skeleton::components.password', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsTextarea', 'skeleton::components.textarea', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsThumbnail', 'skeleton::components.thumbnail', ['source', 'width' => '100', 'label' => '']);
        Form::component('bsImgpreview', 'skeleton::components.imgpreview', ['source', 'width' => '200', 'label' => '']);
        Form::component('bsHidden', 'skeleton::components.hidden', ['name', 'value' => null]);
        Form::component('bsSelect', 'skeleton::components.select', ['name', 'label' => '', 'options' => [], 'value' => null, 'attributes' => []]);
        Form::component('pgHeader', 'skeleton::components.pgHeader', ['pgtitle', 'prevtitle', 'prevroute']);
        Form::component('pgButtons', 'skeleton::components.pgButtons', ['actionLabel', 'cancelRoute']);
        Form::component('bsFile', 'skeleton::components.file', ['name', 'attributes' => []]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        $this->app->register('Bishopm\Skeleton\Providers\ScheduleServiceProvider');
    }
}
