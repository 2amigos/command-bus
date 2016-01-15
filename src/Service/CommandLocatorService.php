<?php
namespace Da\Bus\Service;

use Da\Bus\Command\Command;
use Da\Bus\Exception\UnknownMessageNameException;

interface CommandLocatorService
{
    /**
     * @param string $messageName
     *
     * @return bool
     */
    public function hasCommand($messageName);

    /**
     * @param string $messageName
     *
     * @throws UnknownMessageNameException
     *
     * @return Command
     */
    public function getCommand($messageName);
}
