<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_widget_datetime extends midgardmvc_helper_forms_widget
{
    public function __toString()
    {
        return $this->add_label("<input type='datetime' name='{$this->field->get_name()}' value='{$this->field->get_value()->format(DateTime::RFC3339)}' {$this->get_attributes()}/>");
    }
}
?>
