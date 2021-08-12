<?php

namespace Roublez\Isin\Core;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends BaseCommand {

    /**
     * The input interface
     *
     * @var InputInterface
     */
    protected InputInterface $input;

    /**
     * The output interface
     *
     * @var OutputInterface
     */
    protected OutputInterface $output;

    /**
     * Constructs the base command
     */
    public function __construct () {
        parent::__construct($this->signature());

        $this->setDescription($this->description());
    }

    /**
     * Handles the command
     *
     * @return integer
     */
    protected function handle () : int {
        return self::SUCCESS;
    }

    /**
     * Executes the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute (InputInterface $input, OutputInterface $output) : int {
        $this->input = $input;
        $this->output = $output;
        return $this->handle();
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

    protected function input (string $name) : mixed {
        return $this->input->getArgument($name);
    }
}
