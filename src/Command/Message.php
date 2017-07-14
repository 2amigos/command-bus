<?php

namespace Da\Bus\Command;

interface Message
{
    /**
     * @return string
     */
    public function getName();
}
