<?php
namespace Da\Bus\Middleware;

use Da\Bus\Command\Message;
use Da\Bus\Service\CommandLocatorService;
use Da\Resolver\MessageNameResolver;

class HandlerMiddleware implements Middleware
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
     * HandlerMiddleware constructor.
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
     * @param callable $next
     */
    public function handle(Message $message, callable $next)
    {
        $messageName = $this->messageNameResolver->resolve($message);
        $command = $this->commandLocator->getCommand($messageName);
        $command->execute($message);
        $next($message);
    }
}
