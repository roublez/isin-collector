<?php

namespace Roublez\Isin\Sources\Xetra;

use Roublez\Isin\Collectors\FileCollector;
use Roublez\Isin\Collectors\AbstractCollector;
use Roublez\Isin\IsinDataset;
use Roublez\Isin\Parsers\AbstractParser;
use Roublez\Isin\Parsers\CSVParser;
use Roublez\Isin\Sources\AbstractSource;

class Xetra extends AbstractSource {

    /**
     * Gets the collector instance
     *
     * @return Collectable
     */
    public function collector () : AbstractCollector {
        return new FileCollector(
            'https://www.xetra.com/resource/blob/1528/7f1c46a7a5727312f60eb63fa4b2e0c8/data/t7-xetr-allTradableInstruments.csv',
            'tradable-instruments.csv'
        );
    }

    /**
     * Gets the parser instance
     *
     * @return AbstractParser
     */
    public function parser () : AbstractParser {
        return tap(new CSVParser, function ($parser) {
            $parser->sourceFile = 'tradable-instruments.csv';
            $parser->skipLines = 3;
            $parser->after(function (array $row) {
                return tap(new IsinDataset, function ($dataset) use ($row) {
                    $dataset->isin = $row[3];
                    $dataset->wkn = $row[6];
                    $dataset->name = $row[2];
                });
            });
        });
    }
}
