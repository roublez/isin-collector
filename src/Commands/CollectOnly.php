<?php

namespace Roublez\Isin\Commands;

use Roublez\Isin\Core\Command;
use Symfony\Component\Console\Input\InputArgument;

class CollectOnly extends Command {

    /**
     * The command signature
     *
     * @var string
     */
    protected string $signature = 'collect:only';

    /**
     * The command description
     *
     * @var string
     */
    protected string $description = 'Collects the data from the specified source';

    /**
     * Configures the command
     *
     * @return void
     */
    protected function configure (): void {
        $this->addArgument('source', InputArgument::REQUIRED, 'The dot-notation full qualified class name to the source class');
    }

    /**
     * The handle method
     *
     * @return void
     */
    public function handle () : int {
        source($this->input('source'))();

        return self::SUCCESS;
    }
}
