<?php

namespace Da\Bus\Strategy;

use Da\Bus\Command\Message;
use Da\Bus\Service\CommandLocatorService;
use Da\Resolver\NameResolver;

class ExecuteStrategy implements Strategy
{
    /**
     * @var CommandLocatorService
     */
    private $commandLocator;
    /**
     * @var NameResolver
     */
    private $nameResolver;

    /**
     * ExecuteStrategy constructor.
     *
     * @param CommandLocatorService $commandLocator
     * @param NameResolver          $nameResolver
     */
    public function __construct(CommandLocatorService $commandLocator, NameResolver $nameResolver)
    {
        $this->commandLocator = $commandLocator;
        $this->nameResolver = $nameResolver;
    }

    /**
     * @param Message $message
     */
    public function run(Message $message)
    {
        $messageName = $this->nameResolver->resolve($message);
        $command = $this->commandLocator->getCommand($messageName);
        $command->execute($message);
    }
}
