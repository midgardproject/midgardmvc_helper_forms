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
        if (is_string($value))
        {
            if ($this->widget instanceof midgardmvc_helper_forms_widget_date)
            {
                $value = DateTime::createFromFormat('Y-m-d', $value);
            }
            else
            {
                $value = DateTime::createFromFormat(DateTime::RFC3339, $value);
            }
        }

        if ($value instanceof DateTime)
        {
            if ($value instanceof midgard_datetime)
            {
                $value->setTimestamp($value->getTimestamp());
                $this->value = $value;
                return;
            }
            $new_value = new midgard_datetime();
            $new_value->setTimestamp($value->getTimestamp());
            $value = $new_value;
        }

        $this->value = $value;
    }

    public function validate()
    {
        if (!$this->value instanceof DateTime)
        {
            if (   isset($this->required)
                && $this->required == false)
            {
                return;
            }

            $message = $this->mvc->i18n->get('Value is not a datetime', 'midgardmvc_helper_forms');
            throw new midgardmvc_helper_forms_exception_validation($message." ({$this->name})");
        }
    }
}
?>
