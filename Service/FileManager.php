<?php
/**
 * @author: Alejandro Martínez Peregrina
 * @date: 9/01/19
 */

namespace TalentedPanda\PuzzleProblem\Service;

class FileManager
{
    public function __construct($rootPath = '/va/www/html')
    {
    }

    /**
     * @param string $path
     * @return array
     * @throws \Exception
     */
    public function read(string $path): array
    {
        $lines = [];

        $handle = fopen($_SERVER['HOME'] . DIRECTORY_SEPARATOR . $path, "r");

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
//
//FileManagerFactory {
//    createFileManager(fffff){
//        return new FileManager($dfsadf);
//    }
//}