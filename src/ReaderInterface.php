<?php

namespace PAB2;

use PAB2\Record\RecordInterface;

interface ReaderInterface
{
    /**
     * @return RecordInterface[]
     */
    public function read();
}
