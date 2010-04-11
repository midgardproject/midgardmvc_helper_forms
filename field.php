<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
interface midgardmvc_helper_forms_ifield
{
    public function __construct($name, $required = false);
    public function validate();    
    public function clean();
    public function set_value($value);
    public function get_value();
}

class midgardmvc_helper_forms_field implements midgardmvc_helper_forms_ifield
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
        return;
    }

    public function clean()
    {    
        //$this->value = $this->value; //do nothing    
    }
}
?>