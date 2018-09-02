<?php
/**
 * Created by SlickLabs - Wefabric.
 * User: nathanjansen <nathan@wefabric.nl>
 * Date: 01-09-18
 * Time: 18:42
 */

namespace PAB2;

/**
 * Class ReflectionClass
 * @package PAB2
 */
class ReflectionClass
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;

    /**
     * Immediately Throws an exception on validation errors
     * If this is set to false you can create your own logic
     *
     * @var bool
     */
    protected $throwExceptionOnError = false;

    /**
     * A list of errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * ReflectionClass constructor.
     * @param string $class
     * @throws \ReflectionException
     */
    public function __construct(string $class)
    {
        $this->class = $class;
        $this->reflectionClass = new \ReflectionClass($class);
    }

    /**
     * @param string $class
     * @return ReflectionClass
     * @throws \ReflectionException
     */
    public static function create(string $class)
    {
        return new static($class);
    }

    /**
     * Sets the throw Exception on error to true
     */
    public function throwExceptionOnError()
    {
        $this->throwExceptionOnError = true;

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function isInstantiable()
    {
        if (!$this->reflectionClass->isInstantiable()) {
            $error = sprintf(
                '%s: The provided class `%s` does not exist',
                __METHOD__,
                $this->class
            );

            $this->addError($error);

            if ($this->throwExceptionOnError) {
                throw new \Exception($error);
            }
        }

        return $this;
    }

    /**
     * @param string $interface
     * @throws \Exception
     */
    public function implementsInterface(string $interface)
    {
        if (!$this->reflectionClass->implementsInterface($interface)) {
            $error = sprintf(
                '%s: The provided class `%s` does not implement required interface : %s',
                __METHOD__,
                $this->class,
                $interface
            );

            $this->addError($error);

            if ($this->throwExceptionOnError) {
                throw new \Exception($error);
            }
        }

        return $this;
    }

    public function hasErrors()
    {
        return count($this->errors);
    }

    /**
     * @param string $error
     */
    public function addError(string $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
}
