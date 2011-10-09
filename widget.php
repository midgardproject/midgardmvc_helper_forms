<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
abstract class midgardmvc_helper_forms_widget
{
    protected $field;
    protected $label = '';
    protected $placeholder = '';
    protected $title = '';
    protected $css = '';
    protected $id = '';

    public function __construct(midgardmvc_helper_forms_field $field)
    {
        $this->field = $field;
    }

    public abstract function __toString();

    public function get_label()
    {
        return $this->label;
    }

    public function set_label($label)
    {
        $this->label = $label;
    }

    public function set_placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    /**
     * Sets the title attribute of the widget
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * Sets the CSS class attribute of the widget
     */
    public function set_css($css)
    {
        $this->css = $css;
    }

    /**
     * Sets the id attribute of the widget
     */
    public function set_id($id)
    {
        $this->id = $id;
    }

    public function add_label($form_field)
    {
        if (!$this->label)
        {
            return $form_field;
        }

        return "<label>{$this->label}{$form_field}</label>";
    }

    public function get_attributes()
    {
        $attributes = array();

        if ($this->field->required)
        {
            $attributes[] = 'required=\'required\'';
        }

        if ($this->field->readonly)
        {
            $attributes[] = 'readonly=\'readonly\'';
        }

        if ($this->placeholder)
        {
            $attributes[] = "placeholder='" . str_replace("'", '’', $this->placeholder) . "'";
        }

        if ($this->title)
        {
            $attributes[] = "title='" . str_replace("'", '’', $this->title) . "'";
        }

        if ($this->css)
        {
            $attributes[] = "class='" . str_replace("'", '’', $this->css) . "'";
        }

        if ($this->id)
        {
            $attributes[] = "id='" . str_replace("'", '’', $this->id) . "'";
        }

        return implode(' ', $attributes);
    }

}
?>
