<?php

namespace Roublez\Isin\Core;

use Symfony\Component\Console\Command\Command as BaseCommand;

class Command extends BaseCommand
{
    /**
     * Constructs the base command
     */
    public function __construct () {
        parent::__construct($this->signature());

        $this->setDescription($this->description());
        $this->setCode(fn () => $this->handle());
    }

    /**
     * Gets the signature of the command
     *
     * @return string
     */
    protected function signature () : string {
        return $this->signature;
    }

    /**
     * Gets the description of the command
     *
     * @return string
     */
    protected function description () : string {
        return $this->description;
    }
}
