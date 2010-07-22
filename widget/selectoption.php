<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_selectoption extends midgardmvc_helper_forms_widget
{

    private $options = array();

    public function set_options(array $options)
    {
        foreach($options as $o)
        {
            if (isset($o['description']) && isset($o['value']))
            {
                $this->options[] = $o;
            }
            else
            {
                throw new Exception("Invalid options array");
            }
        }
    
    }

    public function add_option($description, $value)
    {
        $this->options[] = array(
            'description' => $description,
            'value' => $value,
        );
    }

    public function __toString()
    {   
        $output = "<select name='{$this->field->get_name()}' {$this->get_attributes()}>";
        foreach($this->options as $o)
        {
            $output .= "<option value='".$o['value']."' ";
            if ($o['value'] == $this->field->get_value())
            {
                $output .= " selected='selected'";
            }
            $output .= " />";
            $output .= " {$o['description']}</option>";
        }
        $output .= '</select>';
        return $output;
    }

}
?>
