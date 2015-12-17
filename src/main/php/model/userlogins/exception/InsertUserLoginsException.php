<?php
namespace mpstyle\mtoolkit\mentity\model\userlogins\exception;

class InsertUserLoginsException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}