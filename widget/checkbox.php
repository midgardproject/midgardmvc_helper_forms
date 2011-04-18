<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_checkbox extends midgardmvc_helper_forms_widget
{
    /**
     * Deprecated way for setting checkbox label, use set_label instead
     */
    public function set_description($description)
    {
        $this->set_label($description);
    }

    public function __toString()
    {
        $output = "<span><input type='checkbox' name='{$this->field->get_name()}' id='{$this->field->get_name()}' value='1' {$this->get_attributes()}";
        if ($this->field->get_value() == true)
        {
            $output .= " checked='checked'";
        }
        $output .= " />";

        if ($this->label)
        {
            $output .= "<label for='{$this->field->get_name()}'>{$this->label}</label>";
        }

        $output .= "</span>";

        return $output;
    }

}
?>
