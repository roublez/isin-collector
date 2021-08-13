<?php

namespace Roublez\Isin\Collectors;

use GuzzleHttp\Client;

class FileCollector extends AbstractCollector {

    /**
     * The url of the file to download
     *
     * @var string
     */
    protected string $url;

    /**
     * The name of the file to store
     *
     * @var string
     */
    protected string $filename;

    /**
     * The http client
     *
     * @var Client
     */
    private Client $client;

    /**
     * Constructs the file collector
     *
     * @param string $url The url to the file to download
     * @param string $filename The name of the target file
     */
    public function __construct (string $url, string $filename = 'collected') {
        $this->url = $url;
        $this->filename = $filename;
        $this->client = new Client;
    }

    /**
     * Gets the url of the source
     *
     * @return string
     */
    public function getUrl () : string {
        return $this->url;
    }

    /**
     * Gets the filename of the target file
     *
     * @return string
     */
    public function getFilename () : string {
        return $this->filename;
    }

    /**
     * Collects the data from the source and stores it
     *
     * @return void
     */
    public function collect () : void {
        $this->client->get($this->url, [
            'sink' => $this->source->storagePath($this->filename)
        ]);
    }
}
