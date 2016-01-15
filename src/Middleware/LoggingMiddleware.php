<?php
namespace Da\Bus\Middleware;

use Da\Bus\Command\Message;
use Psr\Log\LoggerInterface;

class LoggingMiddleware implements Middleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var string
     */
    private $level;

    /**
     * LoggingMiddleware constructor.
     *
     * @param LoggerInterface $logger
     * @param string $level
     */
    public function __construct(LoggerInterface $logger, $level)
    {
        $this->logger = $logger;
        $this->level = $level;
    }

    /**
     * @param Message $message
     * @param callable $next
     */
    public function handle(Message $message, callable $next)
    {
        $this->logger->log($this->level, 'Started handling a message', ['message' => $message]);
        $next($message);
        $this->logger->log($this->level, 'Finished handling a message', ['message' => $message]);
    }
}
