<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_email extends midgardmvc_helper_forms_field_text
{
    public function validate()
    {
        parent::validate();
        if (filter_var($this->value, FILTER_VALIDATE_EMAIL) === false)
        {
            throw new midgardmvc_helper_forms_exception_validation("The field '{$this->name}' requires a valid email address");
        }
    }

    public function clean()
    {
        parent::clean();
    }    
}
?>
