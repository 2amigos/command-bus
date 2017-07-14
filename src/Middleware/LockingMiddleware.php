<?php

namespace Da\Bus\Middleware;

use Da\Bus\Command\Message;
use Exception;

class LockingMiddleware implements Middleware
{
    /**
     * @var array
     */
    private $queue = [];
    /**
     * @var bool
     */
    private $isHandling = false;

    /**
     * @param Message  $message
     * @param callable $next
     *
     * @throws Exception
     */
    public function handle(Message $message, callable $next)
    {
        $this->queue[] = $message;
        if (!$this->isHandling) {
            $this->isHandling = true;
            while ($message = array_shift($this->queue)) {
                try {
                    $next($message);
                } catch (Exception $e) {
                    $this->isHandling = false;
                    throw $e;
                }
            }
            $this->isHandling = false;
        }
    }
}
