<?php
namespace Da\Resolver;

use Da\Bus\Command\Message;

interface MessageNameResolver
{
    /**
     * @param Message $message
     *
     * @return string
     */
    public function resolve(Message $message);
}
