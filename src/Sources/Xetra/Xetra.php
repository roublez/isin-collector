<?php

namespace Roublez\Isin\Sources\Xetra;

use Roublez\Isin\Collectors\Collectable;
use Roublez\Isin\Collectors\UrlCollector;
use Roublez\Isin\Sources\AbstractSource;

class Xetra extends AbstractSource {

    /**
     * Gets the collector instance
     *
     * @return Collectable
     */
    public function collector () : Collectable {
        return new UrlCollector(
            'https://www.xetra.com/resource/blob/1528/7f1c46a7a5727312f60eb63fa4b2e0c8/data/t7-xetr-allTradableInstruments.csv'
        );
    }
}
