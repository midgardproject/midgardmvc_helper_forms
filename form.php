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
    private $action = '';
    private $method = 'post';
    private $submit = '';

    public function __construct($form_namespace)
    {
        $this->mvc = midgardmvc_core::get_instance();
        parent::__construct($form_namespace);
        $this->set_submit(null, $this->mvc->i18n->get('save', 'midgardmvc_helper_forms'));
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

    public function set_action($action)
    {
        $this->action = $action;
    }

    public function set_method($method)
    {
        $this->method = $method;
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

    /**
     * Sets the submit button of the form
     * using the class definition for CSS
     * and the label for the value attirbute
     */
    public function set_submit($class = null, $label = '', $disabled = null)
    {
        if (is_null($class))
        {
            $class = "midgardmvc_helper_forms_form_save";
        }

        if ($disabled)
        {
            $disabled = 'disabled="disabled"';
        }

        $this->submit = "<input type='submit' class='{$class}' value='{$label}' {$disabled}/>\n";
    }

    public function __toString()
    {
        $form_string  = "<form method='{$this->method}' action='{$this->action}'>\n";
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

        if (!$this->readonly)
        {
            $form_string .= $this->submit;
        }

        $form_string .= "</form>\n";
        return $form_string;
    }
}
?>
