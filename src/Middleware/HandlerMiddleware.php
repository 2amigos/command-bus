<?php
namespace Da\Bus\Middleware;

use Da\Bus\Command\Message;
use Da\Bus\Service\CommandLocatorService;
use Da\Resolver\NameResolver;

class HandlerMiddleware implements Middleware
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
     * HandlerMiddleware constructor.
     *
     * @param CommandLocatorService $commandLocator
     * @param NameResolver $nameResolver
     */
    public function __construct(CommandLocatorService $commandLocator, NameResolver $nameResolver)
    {
        $this->commandLocator = $commandLocator;
        $this->nameResolver = $nameResolver;
    }

    /**
     * @param Message $message
     * @param callable $next
     */
    public function handle(Message $message, callable $next)
    {
        $messageName = $this->nameResolver->resolve($message);
        $command = $this->commandLocator->getCommand($messageName);
        $command->execute($message);
        $next($message);
    }
}
