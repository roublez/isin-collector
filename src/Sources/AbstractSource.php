<?php

namespace Roublez\Isin\Sources;

use Roublez\Isin\Collectors\AbstractCollector;
use Roublez\Isin\Parsers\AbstractParser;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

abstract class AbstractSource {

    /**
     * Gets the collector instance
     *
     * @return Collectable
     */
    abstract function collector () : AbstractCollector;

    /**
     * Gets the parser instance
     *
     * @return AbstractParser
     */
    abstract function parser () : AbstractParser;

    /**
     * Gets the identifier of the source
     *
     * @return string
     */
    public function identifier () : string {
        return collect(explode('\\', $this::class))
            ->reject(fn (string $part) => in_array($part, [ 'Roublez', 'Isin', 'Sources' ]))
            ->map(fn (string $part) => Str::kebab($part))
            ->join('.');
    }

    /**
     * Gets the storage path for the source and creates
     * the directory along the way
     *
     * @return resource
     */
    public function storagePath (string $filename) : string {
        $folders = explode('.', $this->identifier());
        array_unshift($folders, 'storage');

        $path = path(...$folders);
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        array_push($folders, $filename);
        return path(...$folders);
    }

    /**
     * Collects the data from the source
     *
     * @return void
     */
    public function collect () : void {
        tap($this->collector(), fn (AbstractCollector $collector) => $collector->setSource($this))->collect();
    }

    /**
     * Parses the data from the source
     *
     * @return void
     */
    public function parse () : void {
        tap($this->parser(), fn (AbstractParser $parser) => $parser->setSource($this))->parse();
    }

    /**
     * Executes the source handling
     *
     * @return void
     */
    public function run () : void {
        $this->collect();
        $this->parse();
    }

    /**
     * Invokes the run function
     *
     * @return void
     */
    public function __invoke () {
        $this->run();
    }

    public static function all () : Collection {
        return collect(glob(path('src', 'Sources', '**', '*.php')))
            ->map(function ($absolutePath) {

                //
                // Get the search string for splitting the string
                $search = 'src'.\DIRECTORY_SEPARATOR.'Sources'.\DIRECTORY_SEPARATOR;

                //
                // Get the position where the custom folder structure begins
                $position = strpos($absolutePath, $search);

                //
                // Get the path components
                $components = explode(DIRECTORY_SEPARATOR, substr($absolutePath, $position + strlen($search)));

                $source = join('\\', [
                    'Roublez',
                    'Isin',
                    'Sources',
                    ...$components
                ]);

                //
                // Remove the file extension ".php" from the end of the string
                $source = substr($source, 0, strlen($source) - 4);

                return new $source;
            });
    }
}
