<?php

namespace Da\Resolver;

use Da\Bus\Command\Message;

class MessageNameResolver implements NameResolver
{
    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message)
    {
        return $message->getName();
    }
}
