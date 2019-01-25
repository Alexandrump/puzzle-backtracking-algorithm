<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\Service;

use TalentedPanda\PuzzleProblem\Model\Exception\NonValidFilePathException;

class FileManager
{
    /** @var string */
    const TXT_EXTENSION = 'txt';
    /** @var string */
    const SOLUTIONS_FOLDER = 'Solutions';

    /** @var string */
    private $puzzlesPath;
    /** @var string */
    private $publicPath;
    /** @var string */
    private $documentPath = '';

    /**
     * FileManager constructor.
     * @param string $defaultPath
     * @param string $publicPath
     */
    public function __construct(string $defaultPath, string $publicPath)
    {
        $this->puzzlesPath = $defaultPath;
        $this->publicPath = $publicPath;
    }

    /**
     * @param string $file
     * @return false|string
     */
    public function read(string $file)
    {
        $this->setDocumentPath($file);

        return file_get_contents($this->getDocumentPath());
    }

    /**
     * @param string $file
     * @return array
     *
     * @throws NonValidFilePathException
     */
    public function readEachLine(string $file): array
    {
        $lines = [];

        $handle = fopen($this->getPuzzlesPath() . DIRECTORY_SEPARATOR . $file . '.' . self::TXT_EXTENSION, "r");

        if (empty($handle)) {
            throw new NonValidFilePathException();
        }

        while (!feof($handle)) {
            $lines[] = trim(fgets($handle));
        }

        fclose($handle);
        return $lines;
    }

    /**
     * @param string $content
     */
    public function writeAttachingToPublic(string $content)
    {
        file_put_contents(
            $this->getDocumentPath(),
            $content . "\n",
            FILE_APPEND
        );
    }

    /**
     * @return string
     */
    public function getPuzzlesPath(): string
    {
        return $this->puzzlesPath;
    }

    /**
     * @return string
     */
    public function getDocumentPath(): string
    {
        return $this->documentPath;
    }

    /**
     * @param string $documentName
     */
    public function setDocumentPath(string $documentName)
    {
        $this->documentPath = $this->publicPath . DIRECTORY_SEPARATOR . self::SOLUTIONS_FOLDER . DIRECTORY_SEPARATOR . $documentName . '.' . self::TXT_EXTENSION;
    }
}