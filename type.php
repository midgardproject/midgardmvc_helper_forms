<?php
/**
 * @package midgardmvc_helper_forms
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
interface midgardmvc_helper_forms_type
{
    public function __construct($name, $required = false);
    public function validate();    
    //public function clean();
    public function set_value($value);
    public function get_value();
}
?>
