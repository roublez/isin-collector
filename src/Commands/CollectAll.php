<?php

namespace Roublez\Isin\Commands;

use Roublez\Isin\Core\Command;
use Roublez\Isin\Sources\AbstractSource;

class CollectAll extends Command {

    /**
     * The command signature
     *
     * @var string
     */
    protected string $signature = 'collect:all';

    /**
     * The command description
     *
     * @var string
     */
    protected string $description = 'Collects the data from all sources';

    /**
     * The handle method
     *
     * @return void
     */
    public function handle () : int {
        AbstractSource::all()
            ->each(function (AbstractSource $source) {
                $source->collect();
            })
            ->each(function (AbstractSource $source) {
                $source->parse();
            });

        return self::SUCCESS;
    }
}
