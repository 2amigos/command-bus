<?php
namespace Da\Resolver;

use Da\Bus\Command\Message;

interface NameResolver
{
    /**
     * @param Message $message
     *
     * @return string
     */
    public function resolve(Message $message);
}
