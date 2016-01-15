<?php
namespace Da\Bus;

use Da\Bus\Command\Message;
use Da\Bus\Strategy\Strategy;

class Bus
{
    /**
     * @var Strategy
     */
    private $strategy;

    /**
     * Bus constructor.
     *
     * @param Strategy $strategy
     */
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        $this->strategy->run($message);
    }
}
