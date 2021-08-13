<?php

use Roublez\Isin\Sources\AbstractSource;

if (! function_exists('app')) {

    /**
     * Gets the application kernal instance
     *
     * @return \Roublez\Isin\Core\Kernel
     */
    function app () : \Roublez\Isin\Core\Kernel {
        return \Roublez\Isin\Core\Kernel::singleton();
    }
}

if (! function_exists('path')) {

    /**
     * Builds up a string path beginning from the application root
     *
     * @param string ...$args The path components
     * @return string
     */
    function path (string ...$args) : string {
        return app()->path(...$args);
    }
}

if (! function_exists('config')) {

    /**
     * Accesses the configuration
     *
     * @param string|array|int|null $key The config key to access
     * @param mixed $value Sets the value of the configuration key
     * @return mixed
     */
    function config (string|array|int|null $key = null, mixed $value = null) : mixed {
        return app()->config($key, $value);
    }
}

if (! function_exists('source')) {

    /**
     * Gets the class of the identified source
     *
     * @param string $identifier
     * @return AbstractSource
     */
    function source (string $identifier) : AbstractSource {
        $components = collect(explode('.', $identifier))->map(function ($component) {
            return collect(explode('-', $component))->map(fn ($subcomponent) => ucwords($subcomponent))->join('');
        });

        $source = '\\'.collect(['Roublez', 'Isin', 'Sources'])->merge($components)->join('\\');
        return new $source;
    }
}
