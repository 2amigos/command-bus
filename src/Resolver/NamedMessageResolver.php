<?php
namespace Da\Resolver;

use Da\Bus\Command\Message;

class NamedMessageResolver implements MessageNameResolver
{
    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message)
    {
        return $message->getName();
    }
}
