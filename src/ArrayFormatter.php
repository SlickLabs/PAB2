<?php
/**
 * Created by SlickLabs - Wefabric.
 * User: nathanjansen <nathan@wefabric.nl>
 * Date: 01-09-18
 * Time: 18:26
 */

namespace PAB2;

class ArrayFormatter extends AbstractFormatter
{
    /**
     * @param string $content
     * @return array
     */
    public function format(string $line)
    {
        $values = [];
        foreach ($this->conditions as $condition) {
            $values[$condition['key']] = trim(substr($line, $condition['start'], $condition['length']));
        }

        return $values;
    }
}
