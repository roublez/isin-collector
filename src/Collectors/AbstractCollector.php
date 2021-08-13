<?php

namespace Roublez\Isin\Collectors;

use Roublez\Isin\Concerns\InteractsWithSource;

abstract class AbstractCollector {

    use InteractsWithSource;

    /**
     * Collects the data from the source and stores it
     *
     * @return void
     */
    abstract public function collect () : void;

}
