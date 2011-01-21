<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_datetime extends midgardmvc_helper_forms_field
{
    public $format = 'd.m.Y H:i';

    public function __toString()
    {
        return "".$this->value->format($this->format);
    }

    public function set_value($value)
    {
        $this->value = DateTime::createFromFormat(DateTime::RFC3339, $value);
    }
}
?>
