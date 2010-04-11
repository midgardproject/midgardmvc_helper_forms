<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
abstract class midgardmvc_helper_forms_field
{

    private $name = '';
    private $value = '';
    private $required = false;
    private $widget = null;
    
    public function __construct($name, $required = false)
    {
        $this->name = $name;
        $this->required = $required;
    }

    public function __get($key)
    {
        $widget = $key;
        if (strpos($widget, '_') === false)
        {
            // Built-in type called using the shorthand notation
            $widget = "midgardmvc_helper_forms_widget_{$widget}";
        }
        
        if (!is_null($this->widget))
        {
            return $this->widget;
        }

        $this->widget = new $widget($this);
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
    public function get_name()
    {
        return $this->name;
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