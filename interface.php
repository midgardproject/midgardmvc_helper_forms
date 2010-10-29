<?php
class midgardmvc_helper_forms
{
    public static function create($form_namespace = null)
    {
        if (is_null($form_namespace))
        {
            throw new InvalidArgumentException('Namespace for form required');
        }

        // Each form namespace is a singleton
        static $forms_by_namespace = array();
        
        if (isset($forms_by_namespace[$form_namespace]))
        {
            return $forms_by_namespace[$form_namespace];
        }
        
        // Initialize a new form instance
        $forms_by_namespace[$form_namespace] = new midgardmvc_helper_forms_form($form_namespace);

        return $forms_by_namespace[$form_namespace];
    }

    public static function identify_post()
    {
        /* 
        //Removed to allow forms with method GET to pass
        if (midgardmvc_core::get_instance()->context->request_method != 'post')
        {
            return null;
        }
        */
        if (isset($_POST) && isset($_POST['midgardmvc_helper_forms_namespace']))
        {
            return $_POST['midgardmvc_helper_forms_namespace'];
        }        
        elseif(isset($_GET) && isset($_GET['midgardmvc_helper_forms_namespace']))
        {
            return $_GET['midgardmvc_helper_forms_namespace'];        
        }
    
        return null;
    }

}

class midgardmvc_helper_forms_exception_validation extends Exception
{
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }
}
