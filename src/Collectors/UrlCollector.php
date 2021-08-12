<?php

namespace Roublez\Isin\Collectors;

class UrlCollector implements Collectable {

    /**
     * The url of the file to download
     *
     * @var string
     */
    protected string $url;

    /**
     * Constructs the url collector
     *
     * @param string $url The url of the file to download
     */
    public function __construct (string $url) {
        $this->url = $url;
    }

    /**
     * Collects the data from the source and stores it
     *
     * @return void
     */
    public function collect () : void {
        dd($this->url);
    }
}
