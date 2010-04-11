<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_group
{
    private $items = array();
    private $name = '';
    
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function __get($key)
    {
        switch ($key)
        {
            case 'name':
                return $this->name;
            case 'items':
                return $this->items;
        }

        if (!isset($this->items[$key]))
        {
            throw new InvalidArgumentException("{$key} not set for group {$this->name}");
        }
        
        if (isset($this->items[$key]))
        {
            // Return individual item
            return $this->items[$key];
        }
    }

    public function __set($key, $value)
    {    
        if (isset($this->items[$key]))
        {
            $this->items[$key] = $value;
        }      
    }

    public function add_group($name)
    {
        $group = new midgardmvc_helper_forms_group("{$this->name}_{$name}");
        $this->items[$name] = $group;
        return $group;
    }

    public function add_field($name, $field, $required = false, array $actions = array())
    {        
        if (strpos($field, '_') === false)
        {
            // Built-in type called using the shorthand notation
            $field = "midgardmvc_helper_forms_field_{$field}";
        }  

        $this->items[$name] = new $field($name, $required, $actions);

        // If there are values stored in session, set them
        $mvc = midgardmvc_core::get_instance();
        if ($mvc->sessioning->exists('midgardmvc_helper_forms', "stored_{$this->name}"))
        {
            $stored = $mvc->sessioning->get('midgardmvc_helper_forms', "stored_{$this->name}");
            if (isset($stored['fields'][$name]))
            {
                $this->items[$name]->set_value($stored['fields'][$name]['value']);
            }
        }        
    }

    public function process_post()
    {
        foreach ($this->items as $name => $item)
        {
            if ($item instanceof midgardmvc_helper_forms_group)
            {
                // Tell group to process items
                $item->process_post();
                continue;
            }    
            //If item is a field with the proper name, do magic        
            if (isset($_POST[$name]))
            {
                //Set value to the field
                $item->set_value($_POST[$name]);
                //Read actions
                $actions = $item->get_actions();
                //If there are manually defined actions in the array, run them
                if (   is_array($actions) 
                    && count($actions) > 0)
                {
                    foreach($actions as $action)
                    {
                        if (method_exists($item, $action))
                        {
                            $item->$action();
                        }
                        else
                        {
                            $classname = get_class($item);
                            throw new Exception("No action method '$action' implemented for the class '$classname'");
                        }
                    }
                }
                //...or just do what people usually want to do with form fields
                else
                {
                    //Default: First clean, then validate
                    $item->clean();
                    $item->validate();
                }           
            }    
        }
    }
}
