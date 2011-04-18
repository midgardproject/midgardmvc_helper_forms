<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_number extends midgardmvc_helper_forms_widget
{
    public function __construct(midgardmvc_helper_forms_field_integer $field)
    {
        parent::__construct($field);
    }

    public function __toString()
    {
        $step = '';
        if ($this->field instanceof midgardmvc_helper_forms_field_float) {
            $step = ' step="any"';
        }
        $value = str_replace(',', '.', $this->field->get_value());
        return $this->add_label("<input type='number'{$step} name='{$this->field->get_name()}' value='{$value}' {$this->get_attributes()}/>");
    }

}
?>
