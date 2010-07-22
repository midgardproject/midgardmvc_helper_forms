<?php
class midgardmvc_helper_forms_field_boolean extends midgardmvc_helper_forms_field
{
    public function set_value($value)
    {
        if ($value == null)
        {
            //This special case is here because checkboxes (stupidly) post nothing if they are not checked
            $this->value = false;
        }
        else
        {
            $this->value = $value;
        }    
    }

    public function validate()
    {
        // if value is NOT required and it is left empy, validate as true
        if (isset($this->required) && $this->required == false && mb_strlen($this->value) == 0)
        {
            return;
        }
        
        //Special case: We also accept these strings as an input
        if ($this->value === '1')
        {
            $this->value = true;
        }
        elseif($this->value === '0')
        {
            $this->value = false;
        }

        //Checkboxes send value 
        if ($this->value !== 1 && $this->value !== 0 && $this->value !== true && $this->value !== false && $this->value !== null)
        {
            $message = $this->mvc->i18n->get('Value is not a boolean', 'midgardmvc_helper_forms');
            throw new midgardmvc_helper_forms_exception_validation($message);                        
        }    
    }

    public function clean()
    {
        $this->value = (bool) $this->value;
    }
        
}

?>
