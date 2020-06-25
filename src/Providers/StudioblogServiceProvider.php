<?php

namespace Bishopm\Studioblog\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Form;

class StudioblogServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Bishopm\Studioblog\Console\InstallPackageCommand'
    ];

    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(255);
        require __DIR__.'/../Http/api.routes.php';
        require __DIR__.'/../Http/web.routes.php';
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'studioblog');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->publishes([__DIR__.'/../Assets' => public_path('vendor/bishopm')], 'public');
        config(['auth.providers.users.model'=>'Bishopm\Studioblog\Models\User']);
        config(['queue.default'=>'database']);
        Form::component('bsText', 'studioblog::components.text', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'studioblog::components.password', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsTextarea', 'studioblog::components.textarea', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsThumbnail', 'studioblog::components.thumbnail', ['source', 'width' => '100', 'label' => '']);
        Form::component('bsImgpreview', 'studioblog::components.imgpreview', ['source', 'width' => '200', 'label' => '']);
        Form::component('bsHidden', 'studioblog::components.hidden', ['name', 'value' => null]);
        Form::component('bsSelect', 'studioblog::components.select', ['name', 'label' => '', 'options' => [], 'value' => null, 'attributes' => []]);
        Form::component('pgHeader', 'studioblog::components.pgHeader', ['pgtitle', 'prevtitle', 'prevroute']);
        Form::component('pgButtons', 'studioblog::components.pgButtons', ['actionLabel', 'cancelRoute']);
        Form::component('bsFile', 'studioblog::components.file', ['name', 'attributes' => []]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        $this->app->register('Bishopm\Studioblog\Providers\ScheduleServiceProvider');
    }
}
