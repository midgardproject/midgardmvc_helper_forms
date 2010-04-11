<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_url extends midgardmvc_helper_forms_field_text
{

    public function validate()
    {
        parent::__validate();
        // if value is NOT required and it is left empy, validate as true
        if (isset($this->required) && $this->required == false && mb_strlen($this->value) == 0)
        {
            return;
        }            
        if (filter_var($this->value, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED) == false)
        {
            $message = $this->mvc->i18n->get('The field is not a valid url', "midgardmvc_helper_forms");
            throw new midgardmvc_helper_forms_exception_validation($message); 
        }
    }

    public function clean()
    {    
        parent::__clean();
        //add http:// if missing
        if (substr($this->value, 0, 7) != 'http://')
        {
            $this->value = 'http://'.$this->value;
        }
    }
        
}

?>
