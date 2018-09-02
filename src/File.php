<?php
/**
 * Created by SlickLabs - Wefabric.
 * User: nathanjansen <nathan@wefabric.nl>
 * Date: 08-12-17
 * Time: 18:14
 */

namespace PAB2;

use PAB2\Exception\FileException;
use SplFileObject;

/**
 * Class File
 * @package PAB2
 */
class File
{
    /**
     * @var
     */
    protected $path;

    /**
     * @var
     */
    protected $id;

    /**
     * @var SplFileObject
     */
    protected $file;

    /**
     * @var int
     */
    protected $lineCount;

    /**
     * File constructor.
     * @param $path
     */
    public function __construct($id, $path)
    {
        $this->id = $id;
        $this->setPath($path);
        $this->file = new SplFileObject($this->getPath());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $line
     * @return array|\Generator|string
     * @throws FileException
     */
    public function read($line = null)
    {
        if (!$this->exists()) {
            throw new FileException(sprintf(
                'The requested file does not exist on path %s',
                $this->getPath()
            ));
        }

        if ($line) {
            $this->file->seek($line);
            $current = $this->file->current();
            $this->file->rewind();

            return $current;
        }

        foreach ($this->file as $current) {
            yield $current;
        }
    }

    public function lineCount($reload = false)
    {
        if (!$this->lineCount || true === $reload) {
            // Search for the last line
            $this->file->seek($this->file->getSize());
            $this->lineCount = $this->file->key();
        }

        return $this->lineCount;
    }

    /**
     * Returns whether or not the given file path exists
     *
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }
}
