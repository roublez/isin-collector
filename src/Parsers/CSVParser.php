<?php

namespace Roublez\Isin\Parsers;

use Closure;
use Exception;
use Roublez\Isin\IsinDataset;

class CSVParser extends AbstractParser {

    /**
     * The name of the source file to parse
     *
     * @var string
     */
    public string $sourceFile;

    /**
     * The amount of lines to skip before the data parsing begins
     *
     * @var integer
     */
    public int $skipLines;

    /**
     * The columns separator character
     *
     * @var string
     */
    protected string $separator;

    /**
     * The value enclosure character
     *
     * @var string
     */
    protected string $enclosure;

    /**
     * The special char escaping character
     *
     * @var string
     */
    protected string $escape;

    /**
     * The after line read modifier
     *
     * @var Closure
     */
    protected Closure $modifier;

    /**
     * Constructs the CSV parser
     *
     * @param string $separator
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct (string $separator = ';', string $enclosure = '"', string $escape = '\\') {
        $this->sourceFile = 'data.csv';
        $this->skipLines = 0;
        $this->separator = $separator;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
        $this->modifier = fn () => IsinDataset::empty();
    }

    /**
     * Sets the after line read modifier
     *
     * @param Closure $modifier
     * @return void
     */
    public function after (Closure $modifier) {
        $this->modifier = $modifier;
    }

    /**
     * Parses the data from the source to a readable JSON format
     *
     * @return void
     */
    public function parse () : void {

        //
        // Get the path to the source file
        $path = $this->source->storagePath($this->sourceFile);

        $handle = fopen($path, "r");
        if ($handle === false) {
            throw new Exception('Could not open file "'.$path.'"');
        }

        $currentLine = 0;
        $datasets = collect();

        while ($line = fgetcsv($handle, 0, $this->separator, $this->enclosure, $this->escape)) {
            $currentLine++;

            //
            // Ignore lines to skip
            if ($currentLine <= $this->skipLines)
                continue;

            $modifier = $this->modifier;
            $datasets->add($modifier($line));
        }

        fclose($handle);

        dd($datasets->map(fn ($dataset) => json_encode($dataset)));
    }

}
