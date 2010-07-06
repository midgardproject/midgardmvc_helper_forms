<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_checkbox extends midgardmvc_helper_forms_widget
{

    private $description = '';

    public function set_description($description)
    {
        $this->description = $description;
        /*
        $this->options[] = array(
            'description' => $description,
            'value' => $value,
        );
        */
    }

    public function __toString()
    {   
        $output = "<span><input type='checkbox' name='{$this->field->get_name()}' value='1' {$this->get_attributes()}";
        if ($this->field->get_value() == true)
        {
            $output .= " checked='checked'";
        }
        $output .= " />";
        $output .= " <span class='midgardmvc_helper_forms_widget_checkbox_description'>{$this->description}</span></span>";

        return $output;
    }

}
?>
