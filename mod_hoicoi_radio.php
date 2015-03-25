<?php
/**
 * @package    hoicoi_radio
 * @version    v3.2
 * @email      jiboncosta57@gmail.com
 * @author     Jibon Lawrence Costa
 * @link       http://www.hoicoimasti.com
 * @copyright  Copyright (C) 2012 hoicoimasti.com All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');// no direct access
require_once('functions.php');
$turl  = explode(',',trim($params->get('curl')));
$tname = explode(',',trim($params->get('cname')));
$style = trim($params->get('style'));
$moduleclass_sfx = trim($params->get('moduleclass_sfx'));
$popup = trim($params->get('popup'));
$pwby = trim($params->get('pwby'));
$result=join("\n",array_map( 'formatOption', $turl, $tname));
$code = base64_data_encode(htmlspecialchars($result));
$player= JURI::root()."modules/mod_hoicoi_radio/helper.php?d={$code}";

echo "<div style='{$style}' class='{$moduleclass_sfx}'>
<iframe src='{$player}' height='180px' width='100%' frameborder='0' scrolling='no'></iframe>
</div>";

  if ( $popup == 0) {
  
	echo "<script type='text/javascript'>

	function popup(url) 
	{
	 var width  = 300;
	 var height = 200;
	 var left   = (screen.width  - width)/2;
	 var top    = (screen.height - height)/2;
	 var params = 'width='+width+', height='+height;
	 params += ', top='+top+', left='+left;
	 params += ', directories=no';
	 params += ', location=no';
	 params += ', menubar=no';
	 params += ', resizable=no';
	 params += ', scrollbars=no';
	 params += ', status=no';
	 params += ', toolbar=no';
	 newwin=window.open(url,'windowname5', params);
	 if (window.focus) {newwin.focus()}
	 return false;
	}
	</script>";
	?>

<p><a href="javascript: void(0)" onclick="popup('<?php echo $player; ?>')">Play Radio in popup Window </a></p>

<?php
	}

	if ($pwby == 0) {
	echo "<a style ='font-size:10px;text-align:right;' href='http://www.hoicoimasti.com' target='_blank'>Powered By hoicoi radio</a>";
	}
?>
