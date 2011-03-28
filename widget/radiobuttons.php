<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_radiobuttons extends midgardmvc_helper_forms_widget
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
        $output = '<ul class="' . $this->field->get_name() . '">';
        foreach($this->options as $o)
        {
            $output .= "<li><input type='radio' name='{$this->field->get_name()}' value='".$o['value']."' {$this->get_attributes()}";
            if ($o['value'] == $this->field->get_value())
            {
                $output .= " checked='checked'";
            }
            $output .= " />";
            $output .= " <span>{$o['description']}</span></li>";
        }
        $output .= '</ul>';
        return $output;
    }

}
?>
