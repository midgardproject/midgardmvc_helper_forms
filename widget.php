<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
abstract class midgardmvc_helper_forms_widget
{
    protected $field;
        
    public function __construct($field)
    {
        $this->field = $field;
    }

    public abstract function __toString();

    public function get_attributes()
    {
        $attributes = array();
        
        if ($this->field->required)
        {
            $attributes[] = 'required=\'required\'';
        }
        
        return implode(' ', $attributes);
    }
}
?>
