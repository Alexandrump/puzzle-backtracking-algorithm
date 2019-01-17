<?php
/**
 * Created by PhpStorm.
 * User: alejandro.martinez
 * Date: 15/01/19
 * Time: 11:30
 */

namespace TalentedPanda\PuzzleProblem\Model\Exception;

class NonValidFilePathException extends \Exception
{

    /**
     * NonValidFilePathException constructor.
     */
    public function __construct()
    {
        return parent::__construct("This path doesn't exists.");
    }

}