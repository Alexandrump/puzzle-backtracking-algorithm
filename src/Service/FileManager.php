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
    private $defaultPath;

    /**
     * FileManager constructor.
     * @param string $defaultPath
     */
    public function __construct($defaultPath)
    {
        $this->defaultPath = $defaultPath;
    }

    /**
     * @param string $file
     * @return array
     * @throws NonValidFilePathException
     */
    public function read(string $file): array
    {
        $lines = [];

        $handle = fopen($this->defaultPath . DIRECTORY_SEPARATOR . $file, "r");

        if (empty($handle)) {
            throw new NonValidFilePathException();
        }

        while (!feof($handle)) {
            $lines[] = trim(fgets($handle));
        }

        fclose($handle);
        return $lines;
    }

}