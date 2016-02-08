<?php

namespace Da\Bus\Service;

use Da\Bus\Command\Command;
use Da\Bus\Exception\UnknownMessageNameException;

class CallableLocatorService implements CommandLocatorService
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * CallableLocatorService constructor.
     *
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param string $messageName
     *
     * @return bool
     */
    public function hasCommand($messageName)
    {
        return call_user_func($this->callable, $messageName) !== null;
    }

    /**
     * @param string $messageName
     *
     * @throws UnknownMessageNameException
     *
     * @return Command
     */
    public function getCommand($messageName)
    {
        if (!$this->hasCommand($messageName)) {
            throw new UnknownMessageNameException('Unknown message name: '.$messageName);
        }

        return call_user_func($this->callable, $messageName);
    }
}
