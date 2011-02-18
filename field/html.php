<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class midgardmvc_helper_forms_field_html extends midgardmvc_helper_forms_field
{
    protected $inline = false;
    public $purify = true;

    public function validate()
    {
        // if value is NOT required and it is left empy, validate as true
        if (   isset($this->required) 
            && $this->required == false 
            && mb_strlen($this->value) == 0)
        {
            return;
        }        
        if (mb_strlen($this->value) == 0)
        {
            $message = $this->mvc->i18n->get('The field cannot be empty', 'midgardmvc_helper_forms');
            throw new midgardmvc_helper_forms_exception_validation($message);        
        }
    }

    public function set_inline($inline)
    {
        $this->inline = $inline;
    }

    private function get_cache_dir()
    {
        if (extension_loaded('midgard2'))
        {
            $config = midgard_connection::get_instance()->config;
            if (   $config
                && $config->cachedir)
            {
                return "{$config->cachedir}/htmlpurifier";
            }
        }
        return sys_get_temp_dir() . '/htmlpurifier';
    }

    public function purify($content)
    {
        require_once('HTMLPurifier.auto.php');

        $cache_dir = $this->get_cache_dir();
        if (!file_exists($cache_dir))
        {
            mkdir($cache_dir);
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', $cache_dir);
        $config->set('Core.Encoding', 'UTF-8');

        $config->set('HTML.Parent', 'div');
        if ($this->inline)
        {
            $config->set('HTML.Parent', 'span');
        }

        $config->set('HTML.ForbiddenAttributes', array
        (
            'span@style',
            'span@class',
            'div@style',
            'div@class',
            'p@style',
            'p@class',
            'a@style',
            'a@class',
            'pre@style',
            'pre@class',
            'td@style',
            'td@class',
            'dl@style',
            'dl@class',
            'dt@style',
            'dt@class',
            'dd@style',
            'dd@class',
            'ul@style',
            'ul@class',
            'li@style',
            'li@class',
            'b@style',
            'b@class',
        ));
        $config->set('AutoFormat.RemoveEmpty', true);
        $config->set('AutoFormat.RemoveSpansWithoutAttributes', true);
        // FIXME: Change to HTML5 when HTML Purifier supports it
        $config->set('HTML.Doctype', 'XHTML 1.0 Transitional'); // replace with your doctype
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($content);
    }

    public function clean()
    {
        if (!$this->purify)
        {
            $this->value = trim($this->value);
            return;
        }
        $this->value = $this->purify($this->value);
    }
}
?>
