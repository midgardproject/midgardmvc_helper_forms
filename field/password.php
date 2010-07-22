<?php

class midgardmvc_helper_forms_field_password extends midgardmvc_helper_forms_field_text
{

    public function __toString()
    {
        return $this->value."";
    }

    public function validate()
    {    
        // if value is NOT required and it is left empy, validate as true
        if (isset($this->required) && $this->required == false && mb_strlen($this->value) == 0)
        {
            return true;
        }
        
        $mvc = midgardmvc_core::get_instance();
        if (mb_strlen($this->value) < 6)
        {
            $message = $mvc->i18n->get("Password is too short", "midgardmvc_helper_forms");
            throw new midgardmvc_helper_forms_exception_validation($message);                        
        }
        if (mb_strlen($this->value) > 255)
        {
            $message = $mvc->i18n->get("Password is too long", "midgardmvc_helper_forms");
            throw new midgardmvc_helper_forms_exception_validation($message);                        
        }        
        return true;
    }
 
    public function clean()
    {
        //There's no point in clening passwords
        return $this->value;
    }
 
        
}

?>
