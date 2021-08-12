<?php

namespace Roublez\Isin\Core;

use Symfony\Component\Console\Application;
use NunoMaduro\Collision\Provider as CollisionProvider;

class Kernel {

    /**
     * The application name
     * @var string
     */
    private const NAME = 'ISIN Collect';

    /**
     * The application version
     * @var string
     */
    private const VERSION = '0.1';

    /**
     * The singleton kernel instance
     */
    private static Kernel $singleton;

    /**
     * The application component
     */
    private Application $app;

    /**
     * The application configuration
     */
    private Configuration $config;

    /**
     * Constructs the kernel
     *
     * @param Application $app
     */
    public function __construct (Application $app) {
        (new CollisionProvider)->register();

        $this->app = $app;

        $this->app->setName(self::NAME);
        $this->app->setVersion(self::VERSION);

        $this->config = new Configuration($this->path('config.yml'));

        $this->registerCommands();
    }

    /**
     * Gets the kernel singleton instance or instantiates it if it's not set
     *
     * @return Kernel
     */
    public static function singleton () : Kernel {
        if (! isset(Kernel::$singleton)) {
            Kernel::$singleton = new Kernel(new Application);
        }

        return Kernel::$singleton;
    }

    /**
     * Handles the application request
     *
     * @return integer
     */
    public function handle () : int {
        return $this->app->run();
    }

    /**
     * Builds up a string path beginning from the application root
     *
     * @param string ...$args The path components
     * @return string
     */
    public function path (string ...$args) : string {
        return join(DIRECTORY_SEPARATOR, [
            __DIR__,
            '..',
            '..',
            ...$args
        ]);
    }

    /**
     * Accesses the configuration
     *
     * @param string|array|int|null $key The config key to access
     * @param mixed $value Sets the value of the configuration key
     * @return mixed
     */
    public function config (string|array|int|null $key = null, mixed $value = null) : mixed {
        if (isset($value)) {
            return $this->config->set($key, $value);
        }

        return $this->config->get($key);
    }

    /**
     * Registers the application commands
     *
     * @return void
     */
    private function registerCommands () : void {
        $instantiate = function ($absolutePath) {
            $command = join('\\', [
                'Roublez',
                'Isin',
                'Commands',
                basename($absolutePath, '.php')
            ]);

            return new $command;
        };

        $this->app->addCommands(
            array_map($instantiate, glob($this->path('src', 'Commands', '*')))
        );
    }
}
