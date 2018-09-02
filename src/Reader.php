<?php

namespace PAB2;

use PAB2\Record\RecordInterface;
use Tightenco\Collect\Support\Arr;

/**
 * Class Reader
 * @package PAB2
 */
class Reader extends AbstractReader
{
    const SETTING_FORMATTER = 'formatter';

    const SETTING_RECORD_CLASS = 'record_class';

    /**
     * @var File
     */
    protected $file;

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @var RecordInterface
     */
    protected $record;

    /**
     * @var int
     */
    protected $maxLines = 0;

    /**
     * @var int
     */
    protected $linesPerChunk = 0;

    /**
     * @var int
     */
    protected $line;

    /**
     * Reader constructor.
     * @param File $file
     * @param array $settings
     */
    public function __construct(File $file, array $settings = [])
    {
        $this->file = $file;
        $this->setSettings($settings);
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            switch ($key) {
                case self::SETTING_RECORD_CLASS:
                    $this->setRecord($value);
                    break;

                case self::SETTING_FORMATTER:
                    $this->setFormatter($value);
                    break;

            }
        }
    }

    /**
     * @param string $formatter
     * @throws \ReflectionException
     */
    public function setFormatter(string $formatter)
    {
        $this->validateClass($formatter, \PAB2\FormatterInterface::class);

        $this->formatter = $formatter;
    }

    /**
     * @param string $record
     * @throws \ReflectionException
     */
    public function setRecord(string $record)
    {
        $this->validateClass($record, \PAB2\Record\RecordInterface::class);

        $this->record = $record;
    }

    public function maxLines($maxLines)
    {
        $this->maxLines = $maxLines;

        return $this;
    }

    public function linesPerChunk(int $amount)
    {
        $this->linesPerChunk = $amount;

        return $this;
    }

    public function line(int $line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws Exception\FileException
     * @yield RecordInterface[]
     * @return \Generator[RecordInterface[]]
     */
    public function read()
    {
        $i = 1;

        if ($this->hasChunks()) {
            $lineChunkCount = 0;
        }

        $records = [];
        $formatter = new $this->formatter($this->record::getFields());
        $fileId = $this->file->getId();
        $linesLeftCount = $this->file->lineCount();
        foreach ($this->file->read() as $line) {

            $record = new $this->record((int)$fileId, $formatter->format($line));

            // Chunk it up
            // Breaks the file up into chunks and yields the chunk
            if ($this->hasChunks()) {
                $records[] = $record;
                $isChunkMaxReached = $this->linesPerChunk === ($lineChunkCount + 1);
                $isLastChunk = $this->linesPerChunk + $i > $linesLeftCount;

                if ($isChunkMaxReached || $isLastChunk) {
                    yield collect($records);

                    $records = [];
                    $lineChunkCount = 0;
                }

                $lineChunkCount++;
            } else {
                yield $record;
            }

            // Max lines
            // If there is a maximum line count and it is reached break the foreach
            $hasMaxLines = $this->hasMaxLines();
            $isMaxLinesReached = $i === $this->maxLines;

            if ($hasMaxLines && $isMaxLinesReached) {
                break;
            }

            $linesLeftCount--;
            $i++;
        }

        unset($fileId);
        unset($formatter);

        // Resets the settings
        $this->resetSettings();
    }

    public function hasChunks()
    {
        return 0 !== $this->linesPerChunk;
    }

    public function hasMaxLines()
    {
        return 0 !== $this->maxLines;
    }

    public function resetSettings()
    {
        $this->linesPerChunk = 0;
        $this->maxLines = 0;

        return $this;
    }

    /**
     * @return int
     */
    public function lineCount()
    {
        return $this->file->lineCount();
    }
}
