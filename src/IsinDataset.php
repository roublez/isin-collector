<?php

namespace Roublez\Isin;

use JsonSerializable;

class IsinDataset implements JsonSerializable {

    /**
     * The isin
     *
     * @var string
     */
    public string $isin;

    /**
     * The wkn
     *
     * @var string
     */
    public string $wkn;

    /**
     * The name of the company
     *
     * @var string
     */
    public string $name;

    /**
     * Creates an empty isin dataset
     *
     * @return IsinDataset
     */
    public static function empty () : IsinDataset {
        return new IsinDataset;
    }

    /**
     * Serializes the dataset into json
     *
     * @return mixed
     */
    public function jsonSerialize () : mixed {
        return $this;
    }
}
