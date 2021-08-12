<?php

namespace Roublez\Isin\Collectors;

interface Collectable {

    /**
     * Collects the data from the source and stores it
     *
     * @return void
     */
    public function collect () : void;

}
