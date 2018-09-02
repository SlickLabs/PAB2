<?php
/**
 * Created by SlickLabs - Wefabric.
 * User: nathanjansen <nathan@wefabric.nl>
 * Date: 08-12-17
 * Time: 19:46
 */

namespace PAB2;

/**
 * Interface FormatterInterface
 * @package PAB2
 */
interface FormatterInterface
{
    /**
     * @param array $lines
     * @return mixed
     */
    public function format(string $line);
}
