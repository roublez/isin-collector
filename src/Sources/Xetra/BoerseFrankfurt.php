<?php

namespace Roublez\Isin\Sources\Xetra;

use Roublez\Isin\Sources\AbstractSource;
use Roublez\Isin\Collectors\FileCollector;
use Roublez\Isin\Collectors\AbstractCollector;
use Roublez\Isin\Parsers\AbstractParser;
use Roublez\Isin\Parsers\CSVParser;

class BoerseFrankfurt extends AbstractSource {

    /**
     * Gets the collector instance
     *
     * @return Collectable
     */
    public function collector () : AbstractCollector {
        return new FileCollector(
            'https://www.xetra.com/resource/blob/2289108/5f55fb89e15992b75d56fcce7d942937/data/t7-xfra-BF-allTradableInstruments.csv',
            'tradable-instruments.csv'
        );
    }

    /**
     * Gets the parser instance
     *
     * @return AbstractParser
     */
    public function parser () : AbstractParser {
        return new CSVParser(

        );
    }
}
