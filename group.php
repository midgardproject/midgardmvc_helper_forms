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

    public function add_field($name, $type)
    {        
        if (strpos($type, '_') === false)
        {
            // Built-in type called using the shorthand notation
            $type = "midgardmvc_helper_forms_type_{$type}";
        }  

        $this->items[$name] = new $type("{$this->name}_{$name}");

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
            
            if (isset($_POST[$name]))
            {
                $item->set_value($_POST[$name]);
            }        
            // TODO: validate and/or clean
        }
    }
}
