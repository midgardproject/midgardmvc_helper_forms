<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_ipaddress extends midgardmvc_helper_forms_field
{

    public function validate()
    {
        // if value is NOT required and it is left empy, validate as true
        if (isset($this->required) && $this->required == false && mb_strlen($this->value) == 0)
        {
            return;
        }
        
        $ip_array = explode('.', $this->value);
        if (sizeof($ip_array) != 4)
        {
            $message = $mvc->i18n->get('IP address is not valid', 'midgardmvc_helper_forms');
            throw new midgardmvc_helper_forms_exception_validation($message);         
        }        
        $pattern = "/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/";           
        preg_match($pattern, $this->value, $matches);        
        if (count($matches) == 0)
        {
            $message = $this->mvc->i18n->get('IP address is not valid', "midgardmvc_helper_forms");
            throw new midgardmvc_helper_forms_exception_validation($message); 
        }
        if (preg_match($pattern, $this->value) == false)
        {
            $message = $this->mvc->i18n->get('IP address is not valid', "midgardmvc_helper_forms");
            throw new midgardmvc_helper_forms_exception_validation($message); 
        }
    }
    
    public function clean()
    {
        $this->value = trim($this->value);
    }



        
}

?>
