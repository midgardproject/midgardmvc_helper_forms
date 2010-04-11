<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_type_text implements midgardmvc_helper_forms_type
{
    private $name = '';
    private $value = '';
    private $required = false;
    
    public function __construct($name, $required = false)
    {
        $this->name = $name;
        $this->required = $required;
    }

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

    public function validate()
    {
        // if value is NOT required and it is left empy, validate as true
        if (   isset($this->required) 
            && $this->required == false 
            && mb_strlen($this->value) == 0)
        {
            return true;
        }
        
        if (mb_strlen($this->value) == 0)
        {
            throw new midgardmvc_helper_forms_exception_validation('The field cannot be empty');
        }
        
        return true;    
    }

    public function clean()
    {
        return trim(strip_tags($this->value));
    }    
}
?>
