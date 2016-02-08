<?php

namespace Da\Bus\Strategy;

use Da\Bus\Command\Message;
use Da\Bus\Middleware\Middleware;

class MiddlewareStrategy implements Strategy
{
    /**
     * @var Middleware[]
     */
    protected $middlewares;

    /**
     * MiddlewareStrategy constructor.
     *
     * @param Middleware[] $middlewares
     */
    public function __construct(array $middlewares = [])
    {
        $this->setMiddlewares($middlewares);
    }

    /**
     * @param array $middlewares
     */
    public function setMiddlewares(array $middlewares)
    {
        foreach ($middlewares as $middleware) {
            $this->addMiddleware($middleware);
        }
    }

    /**
     * @param Middleware $middleware
     */
    public function addMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @param Message $message
     */
    public function run(Message $message)
    {
        call_user_func($this->call(0), $message);
    }

    /**
     * @param $index
     *
     * @return \Closure
     */
    private function call($index)
    {
        if (!isset($this->middlewares[$index])) {
            return function () {
            };
        }
        $middleware = $this->middlewares[$index];

        return function ($message) use ($middleware, $index) {
            $middleware->handle($message, $this->call($index + 1));
        };
    }
}
