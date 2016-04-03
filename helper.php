<?php

defined('_JEXEC') or die('Restricted access');

/**
 * @author     Jibon Lawrence Costa
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
class modHoicoiRadioHelper {

    public static function getAjax() {

        jimport('joomla.application.module.helper');

        $input = JFactory::getApplication()->input;
        if ($input->get("url", " ", "STRING") !== JUri::base()) {
            return false;
        }
        $module = JModuleHelper::getModule('hoicoi_radio');
        $params = new JRegistry();
        $params->loadString($module->params);

        $channels = explode(',', rtrim($params->get('channels'), ","));
        $options = "";
        if (is_array($channels)) {
            return modHoicoiRadioHelper::formatChannnels($channels);
        }

        return false;
    }

    /**
     *
     * @param type $channels array
     * @return formated option
     */
    static public function formatChannnels($channels) {
        $options = "";

        foreach ($channels as $channel) {

            $data = explode("|", $channel);

            if (trim($data[1]) == "local") {
                $options .= self::getDirectoryFiles($data[2]);
            } else {
                $options .= '<option id="' . $data[0] . '" value="' . base64_encode(trim($data[2])) . '">' . trim($data[1]) . '</option>';
            }
        }

        return $options;
    }

    /**
     * Get all the files under a directory
     * @param type $dir
     * @return string
     */
    static private function getDirectoryFiles($dir) {
        $options = "";
        $dirFormate = JPATH_ROOT . DIRECTORY_SEPARATOR . trim($dir);

        //$allow = implode('|', $allow);

        if ($handle = opendir($dirFormate)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $path_parts = pathinfo($file);
                    if (self::searchAllowFiles($path_parts['extension'])) {
                        $options .= '<option value="' . base64_encode(JUri::base() . $dir . "/" . $file) . '">' . $path_parts['filename'] . '</option>';
                    }
                }
            }
            closedir($handle);
        }
        return $options;
    }

    static private function searchAllowFiles($file_tyle) {
        $allow = array('mp3', 'wma', 'm4a', 'wav', 'mpeg', 'flv');
        foreach ($allow as $a) {
            if ($a == $file_tyle) {
                return true;
                break;
            }
        }
        return false;
    }

}
