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
    private $documentPath;

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
     * @param string $folder
     * @param string $file
     * @throws NonValidFilePathException
     */
    public function readFromPublic(string $file)
    {
        $this->setDocumentPath($this->publicPath . DIRECTORY_SEPARATOR . self::SOLUTIONS_FOLDER . DIRECTORY_SEPARATOR . $file . '.' . self::TXT_EXTENSION);

        if (!$this->existWithData()) {
            throw new NonValidFilePathException();
        }

        $fileContent = fopen($document, "r");
        echo fread($fileContent, filesize($document));
        fclose($fileContent);
    }

    /**
     * @param string $file
     * @return array
     * @throws NonValidFilePathException
     */
    public function readFromPuzzles(string $file): array
    {
        $lines = [];

        $handle = fopen($this->puzzlesPath . DIRECTORY_SEPARATOR . $file . '.' . self::TXT_EXTENSION, "r");

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
     * @param string $file
     * @param string $content
     */
    public function writeAttaching(string $file, string $content)
    {
        if (!$this->existWithData()) {
            $this->setDocumentPath($this->publicPath . DIRECTORY_SEPARATOR . self::SOLUTIONS_FOLDER . DIRECTORY_SEPARATOR . $file . '.' . self::TXT_EXTENSION);
        }

        file_put_contents(
            $this->getDocumentPath(),
            $content . "\n"

        );
//        $fileContent = fopen($document, "r");
//        echo fread($fileContent, filesize($document));
//        fclose($fileContent);

    }

    /**
     * @param string $file
     * @return bool
     */
    public function existWithData(): bool
    {
        $fileContent = fopen($this->getDocumentPath(), "r");
        fclose($fileContent);
        return (!empty($fileContent));
    }

    /**
     * @return string
     */
    public function getDocumentPath(): string
    {
        return $this->documentPath;
    }

    /**
     * @param string $documentPath
     */
    public function setDocumentPath(string $documentPath): string
    {
        $this->documentPath = $documentPath;
    }

}