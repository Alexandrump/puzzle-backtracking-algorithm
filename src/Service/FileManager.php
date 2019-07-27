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
    const JSON_EXTENSION = 'json';

    /** @var string */
    private $puzzlesPath;
    /** @var string */
    private $publicPath;
    /** @var string */
    private $solutionsFolder;
    /** @var string */
    private $documentPath = '';

    /**
     * FileManager constructor.
     * @param string $defaultPath
     * @param string $publicPath
     * @param string $solutionsFolder
     */
    public function __construct(string $defaultPath, string $publicPath, string $solutionsFolder)
    {
        $this->puzzlesPath = $defaultPath;
        $this->publicPath = $publicPath;
        $this->solutionsFolder = $solutionsFolder;
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
     * @param string $extension
     */
    public function setDocumentPath(string $documentName, string $extension = self::TXT_EXTENSION): void
    {
        $this->documentPath = $this->publicPath . DIRECTORY_SEPARATOR . $this->solutionsFolder . DIRECTORY_SEPARATOR . $documentName . '.' . $extension;
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
     * @return false|string
     */
    public function readSolutions(): ?string
    {
        return file_get_contents($this->getDocumentPath());
    }

    /**
     * @param $content
     */
    public function writeSolutions($content): void
    {
        file_put_contents(
            $this->getDocumentPath(),
            $content . "\n"
        );
    }

}