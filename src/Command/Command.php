<?php
namespace Da\Bus\Command;

interface Command
{
    /**
     * @param Message $message
     *
     */
    public function execute(Message $message);
}
