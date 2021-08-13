<?php

namespace Roublez\Isin\Concerns;

use Roublez\Isin\Sources\AbstractSource;

trait InteractsWithSource {

    /**
     * The reference to the source
     *
     * @var AbstractSource
     */
    protected AbstractSource $source;

    /**
     * Sets the source
     *
     * @param AbstractSource $source
     * @return void
     */
    public function setSource (AbstractSource $source) : void {
        $this->source = $source;
    }
}
