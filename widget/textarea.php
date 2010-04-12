<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_textarea extends midgardmvc_helper_forms_widget_text
{

    public function __toString()
    {    
        return $this->add_label("<textarea name='{$this->field->get_name()}'{$this->get_attributes()}>{$this->field->get_value()}</textarea>");
    }

}
?>
