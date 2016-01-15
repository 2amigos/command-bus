<?php
namespace Da\Bus\Strategy;

use Da\Bus\Command\Message;

interface Strategy
{
    public function run(Message $message);
}
