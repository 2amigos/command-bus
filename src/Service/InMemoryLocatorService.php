<?php
namespace Da\Bus\Service;

use Da\Bus\Command\Command;
use Da\Bus\Exception\UnknownMessageNameException;

class InMemoryLocatorService implements CommandLocatorService
{
    /**
     * @var
     */
    private $map;

    /**
     * InMemoryLocatorService constructor.
     *
     * @param array $messageToCommandMap
     */
    public function __construct(array $messageToCommandMap = [])
    {
        $this->setMessageCommandMap($messageToCommandMap);
    }

    /**
     * @param array $messageToCommandMap
     */
    public function setMessageCommandMap(array $messageToCommandMap)
    {
        foreach ($messageToCommandMap as $messageName => $command) {
            $this->addMessageCommand($command, $messageName);
        }
    }

    /**
     * @param $command
     * @param $messageName
     */
    public function addMessageCommand($command, $messageName)
    {
        $this->map[$messageName] = $command;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCommand($messageName)
    {
        return isset($this->map[$messageName]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand($messageName)
    {
        if (!$this->hasCommand($messageName)) {
            throw new UnknownMessageNameException('Unknown message name: ' . $messageName);
        }

        return $this->getCommandInstance($messageName);
    }

    /**
     * @param $messageName
     *
     * @return Command
     */
    protected function getCommandInstance($messageName)
    {
        $command = $this->map[$messageName];

        if (!is_object($command)) {
            $command = new $command();
            $this->map[$messageName] = $command;
        }

        return $command;
    }
}
