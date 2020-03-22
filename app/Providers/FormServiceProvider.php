<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', [
            'label',
            'name',
            'value',
            'attributes'
        ]);

        Form::component('bsPassword', 'components.form.password', [
            'label',
            'name',
            'value',
            'attributes'
        ]);

        Form::component(
            'bsSelect',
            'components.form.select',
            [
                'label',
                'name',
                'value' => null,
                'default_value' => null,
                'attributes' => [],
                'action' => null
            ]
        );

        Form::component(
            'bsFile',
            'components.form.file',
            [
                'label',
                'name',
                'value' => null,
                'attributes' => [],
                'action' => null
            ]
        );
    }
}
