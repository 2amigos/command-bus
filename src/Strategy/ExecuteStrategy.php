<?php
namespace Da\Bus\Strategy;

use Da\Bus\Command\Message;
use Da\Bus\Service\CommandLocatorService;
use Da\Resolver\MessageNameResolver;

class ExecuteStrategy implements Strategy
{
    /**
     * @var CommandLocatorService
     */
    private $commandLocator;
    /**
     * @var MessageNameResolver
     */
    private $messageNameResolver;

    /**
     * ExecuteStrategy constructor.
     *
     * @param CommandLocatorService $commandLocator
     * @param MessageNameResolver $messageNameResolver
     */
    public function __construct(CommandLocatorService $commandLocator, MessageNameResolver $messageNameResolver)
    {
        $this->commandLocator = $commandLocator;
        $this->messageNameResolver = $messageNameResolver;
    }

    /**
     * @param Message $message
     */
    public function run(Message $message)
    {
        $messageName = $this->messageNameResolver->resolve($message);
        $command = $this->commandLocator->getCommand($messageName);
        $command->execute($message);
    }
}
