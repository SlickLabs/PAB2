<?php
/**
 * Created by SlickLabs - Wefabric.
 * User: nathanjansen <nathan@wefabric.nl>
 * Date: 08-12-17
 * Time: 19:36
 */

namespace PAB2;

/**
 * Class AbstractFormatter
 * @package PAB2
 */
abstract class AbstractFormatter implements FormatterInterface
{
    protected $conditions;

    public function __construct($conditions)
    {
        $this->setConditions($conditions);
    }

    /**
     * @param string $content
     * @return array
     */
    abstract public function format(string $line);

    /**
     * @param array $conditions
     */
    public function setConditions(array $conditions)
    {
        $this->conditions = $conditions;
    }
}
