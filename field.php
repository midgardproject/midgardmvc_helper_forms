<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
abstract class midgardmvc_helper_forms_field
{
    protected $name = '';
    protected $value = null;
    protected $required = false;
    protected $widget = null;
    protected $actions = array();
    protected $mvc = null;
    
    public function __construct($name, $required = false, array $actions = array())
    {
        $this->name = $name;
        $this->required = $required;
        $this->actions = $actions;
        $this->mvc = midgardmvc_core::get_instance();
    }

    public function __get($key)
    {
        if ($key == 'value')
        {
            return $this->value;
        }
        
        if ($key == 'widget')
        {
            return $this->widget;
        }
        
        return $this->set_widget($key);
    }
    
    public function set_widget($widget)
    {
        if (!is_null($this->widget))
        {
            // This field has a widget already
            return $this->widget;
        }
        
        if (strpos($widget, '_') === false)
        {
            // Built-in type called using the shorthand notation
            $widget = "midgardmvc_helper_forms_widget_{$widget}";
        } 
        
        $this->widget = new $widget($this);
        // TODO: Check widget compatibility with type
        return $this->widget;
    }

    public function __toString()
    {
        return "".$this->value;
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
    public function get_actions()
    {
        return $this->actions;
    }
    public function validate()
    {
        return;
    }

    public function clean()
    {    
        //do nothing    
    }
}
?>
