<?php
/**
 * @use	       various useful functions
 * @package    hoicoi_radio
 * @version    v3.2
 * @email      jiboncosta57@gmail.com
 * @author     Jibon Lawrence Costa
 * @link       http://www.hoicoimasti.com
 * @copyright  Copyright (C) 2012 hoicoimasti.com All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

function formatOption($url,$name){
    return "<option value='$url=>$name'>$name</option>";
    }
    
function base64_data_encode($data) {
    return strtr(base64_encode($data), '+/=', '-_,');
    }

function base64_data_decode($data) {
    return base64_decode(strtr($data, '-_,', '+/='));
    }

?>
