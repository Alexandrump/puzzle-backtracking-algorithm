<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace Application\Service;

class FileManager
{
    /**
     * @param string $path
     * @return array
     */
    public function read(string $path): array
    {
        $lines = [];
        $handle = fopen($_SERVER['HOME'] . DIRECTORY_SEPARATOR . $path, "r");

        while (!feof($handle)) {
            $lines[] = trim(fgets($handle));
        }

        fclose($handle);
        return $lines;
    }
}