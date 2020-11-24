<?php 
namespace chikari\core\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access thispage';
    protected $code = 403;
}

?>