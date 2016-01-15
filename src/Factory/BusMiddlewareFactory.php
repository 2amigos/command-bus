<?php
namespace Da\Bus\Factory;

use Da\Bus\Bus;
use Da\Bus\Middleware\HandlerMiddleware;
use Da\Bus\Middleware\LockingMiddleware;
use Da\Bus\Service\InMemoryLocatorService;
use Da\Bus\Strategy\MiddlewareStrategy;
use Da\Resolver\ClassNameResolver;

class BusMiddlewareFactory
{
    /**
     * {@inheritdoc}
     */
    public static function create(array $messageToCommandMap)
    {
        $strategy = new MiddlewareStrategy(
            [
                new LockingMiddleware(),
                new HandlerMiddleware(new InMemoryLocatorService($messageToCommandMap), new ClassNameResolver()),
            ]
        );

        return new Bus($strategy);
    }
}
