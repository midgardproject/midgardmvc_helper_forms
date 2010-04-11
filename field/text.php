<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_text extends midgardmvc_helper_forms_field
{

    /*
    public function __toString()
    {
        return $this->value;
    }

    public function set_value($value)
    {
        $this->value = $value;
    }

    public function get_value()
    {
        return $this->value;
    }
    */
    public function validate()
    {
        // if value is NOT required and it is left empy, validate as true
        if (   isset($this->required) 
            && $this->required == false 
            && mb_strlen($this->value) == 0)
        {
            return;
        }        
        if ($this->value != strip_tags($this->value))
        {
            throw new midgardmvc_helper_forms_exception_validation("HTML tags are not allowed in a text field");        
        }
        if (mb_strlen($this->value) == 0)
        {
            throw new midgardmvc_helper_forms_exception_validation("The field '{$this->name}' cannot be empty");
        }
    }

    public function clean()
    {
        $this->value = trim(strip_tags($this->value));
    }    
}
?>
