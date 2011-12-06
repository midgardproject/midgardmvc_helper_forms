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
        if ($this->label)
        {
            $output = "\n<label class=" . $this->field->get_name() . ">";
            $output .= $this->label;
            $output .= "</label>\n";
        }

        $output .= '<ul class="radio">' . "\n";
        $checked = false;

        foreach($this->options as $o)
        {
            $default = false;
            if (substr($o['description'], strlen($o['description']) - 1) == '*')
            {
                $default = true;
                $o['description'] = substr($o['description'], 0, strlen($o['description']) - 1);
            }

            $output .= "  <li>\n";
            $output .= '    <input type="radio" name="' . $this->field->get_name() . '" value="' . $o['value'] . '"' . $this->get_attributes();

            if (   $this->field->get_value() == ''
                && $default
                && ! $checked)
            {
                $output .= ' checked="checked"';
                $checked = true;
            }
            else
            {
                if ($o['value'] == $this->field->get_value())
                {
                    $output .= ' checked="checked"';
                    $checked = true;
                }
            }
            $output .= ">\n";
            $output .= "    <span>" . $o['description'] . "</span>\n";
            $output .= "  </li>\n";
        }
        $output .= "</ul>\n";

        return $output;
    }

}
?>
