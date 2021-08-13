<?php

namespace Roublez\Isin\Parsers;

use Roublez\Isin\Concerns\InteractsWithSource;

abstract class AbstractParser {

    use InteractsWithSource;

    /**
     * Parses the data from the source to a readable JSON format
     *
     * @return void
     */
    abstract public function parse () : void;

}
