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
    public function read($maxLines = 0)
    {
        $i = 1;

        $formatter = new $this->formatter($this->record::getFields());
        $fileId = $this->file->getId();
        $linesLeftCount = $this->file->lineCount();
        foreach ($this->file->read() as $line) {

            yield new $this->record((int)$fileId, $formatter->format($line));

            // Max lines
            // If there is a maximum line count and it is reached break the foreach
            $hasMaxLines = 0 !== $maxLines;
            $isMaxLinesReached = $i === $maxLines;

            if ($hasMaxLines && $isMaxLinesReached) {
                break;
            }

            $linesLeftCount--;
            $i++;
        }

        unset($maxLines, $formatter, $hasMaxLines, $isMaxLinesReached, $fileId, $formatter, $linesLeftCount, $i);
    }

    public function chunk(int $size)
    {
        $i = 1;
        $lineChunkCount = 0;

        $records = [];
        $formatter = new $this->formatter($this->record::getFields());
        $fileId = $this->file->getId();
        $linesLeftCount = $this->file->lineCount();
        foreach ($this->file->read() as $line) {

            $records[] = new $this->record((int)$fileId, $formatter->format($line));
            $isChunkMaxReached = $size === ($lineChunkCount + 1);
            $isLastChunk = $size + $i > $linesLeftCount;

            if ($isChunkMaxReached || $isLastChunk) {
                yield collect($records);

                $records = [];
                $lineChunkCount = 0;
            }

            $lineChunkCount++;
            $linesLeftCount--;
            $i++;
        }

        unset($i, $lineChunkCount, $records, $formatter, $fileId, $linesLeftCount, $isChunkMaxReached, $isLastChunk);
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
