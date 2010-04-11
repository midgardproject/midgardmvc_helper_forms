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
            $message = $this->mvc->i18n->get('The field requires a valid email address', 'midgardmvc_helper_forms');
            throw new midgardmvc_helper_forms_exception_validation($message);                        
        }
    }

    public function clean()
    {
        parent::clean();
    }    
}
?>
