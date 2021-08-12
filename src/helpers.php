<?php

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
