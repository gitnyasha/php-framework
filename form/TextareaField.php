<?php 
namespace chikari\core\form;
use chikari\core\Model;

use chikari\core\form\BaseField;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
        $this->attribute,
        $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        $this->model->{$this->attribute}
        );
    }
}
?>