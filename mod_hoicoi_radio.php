<?php

/**
 * @package    Hoicoi Radio
 * @subpackage Base
 * @author     Jibon Lawrence Costa
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access'); // no direct access
include_once 'helper.php';
$channels = explode(',', rtrim($params->get('channels'), ","));
$options = "";

if (is_array($channels)) {
    $options = modHoicoiRadioHelper::formatChannnels($channels);
}

require(JModuleHelper::getLayoutPath('mod_hoicoi_radio'));
?>