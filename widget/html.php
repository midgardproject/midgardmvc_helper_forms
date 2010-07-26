<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_html extends midgardmvc_helper_forms_widget_textarea
{

    public function __toString()
    {    
        $html  = "<textarea class='{$this->field->get_name()}' name='{$this->field->get_name()}'{$this->get_attributes()}>{$this->field->get_value()}</textarea>";
        return $this->add_label($html);
    }

}
?>
