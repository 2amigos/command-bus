<?php

namespace Da\Resolver;

use Da\Bus\Command\Message;

class ClassNameResolver implements NameResolver
{
    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message)
    {
        return get_class($message);
    }
}
