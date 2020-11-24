<?php 

namespace chikari\core;

use chikari\core\db\DbModel;


abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}
?>