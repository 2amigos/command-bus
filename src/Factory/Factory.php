<?php
namespace Da\Bus\Factory;

use Da\Bus\Bus;

interface Factory
{
    /**
     * @param array $messageToCommandMap
     *
     * @return Bus
     */
    public function create(array $messageToCommandMap);
}
