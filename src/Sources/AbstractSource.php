<?php

namespace Roublez\Isin\Sources;

use Roublez\Isin\Collectors\Collectable;

abstract class AbstractSource {

    /**
     * Gets the collector instance
     *
     * @return Collectable
     */
    abstract function collector () : Collectable;

}
