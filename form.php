<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_form extends midgardmvc_helper_forms_group
{
    private $mvc = null;
    private $post_processed = false;

    public function __construct($form_namespace)
    {
        $this->mvc = midgardmvc_core::get_instance();
        parent::__construct($form_namespace);
    }

    public function __get($key)
    {
        if (   isset($this->items[$key])
            && $this->mvc->context->request_method == 'post'
            && !$this->post_processed)
        {
            // TODO: Process??
        }      
        if ($key == 'namespace')
        {
            return parent::__get('name');
        }
        
        return parent::__get($key);
    }

    public function process_post()
    {
        parent::process_post();
        $this->post_processed = true;
    }

    // Stores values to session
    public function store()
    {
        $mvc = midgardmvc_core::get_instance();
        $stored = array();
        foreach ($this->items as $name => $item)
        {
            if (!$item instanceof midgardmvc_helper_forms_type)
            {
                continue;
            }
            $stored[$name] = $item->get_value();
        }
        $mvc->sessioning->set('midgardmvc_helper_forms', "stored_{$this->namespace}", $stored);
    }
    
    public function clean_store()
    {
        $mvc = midgardmvc_core::get_instance();
        if (!$mvc->sessioning->exists('midgardmvc_helper_forms', "stored_{$this->namespace}"))
        {
            return;
        }
        $mvc->sessioning->remove('midgardmvc_helper_forms', "stored_{$this->namespace}");
    }
    
    public function __toString()
    {
        $form_string  = "<form method='post' action=''>\n";
        $form_string .= "<input type='hidden' name='midgardmvc_helper_forms_namespace' value='{$this->namespace}' />\n";
        foreach ($this->items as $item)
        {
            if ($item instanceof midgardmvc_helper_forms_group)
            {
                $form_string .= $item;
                continue;
            }
            $form_string .= $item->widget;
        }
        $form_string .= "<input type='submit' value='Save' />\n";
        $form_string .= "</form>\n";
        return $form_string;
    }
}
?>
