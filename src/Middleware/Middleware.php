<?php
namespace Da\Bus\Middleware;

use Da\Bus\Command\Message;

interface Middleware
{
    /**
     * @param Message $message
     * @param callable $next
     *
     */
    public function handle(Message $message, callable $next);
}
