<?php
namespace mpstyle\mtoolkit\mentity\model\role\exception;

class InsertRoleException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}