<?php
/**
 * @use	       Configure the player
 * @package    hoicoi_radio
 * @version    v3.2
 * @email      jiboncosta57@gmail.com
 * @author     Jibon Lawrence Costa
 * @link       http://www.hoicoimasti.com
 * @copyright  Copyright (C) 2012 hoicoimasti.com All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
require_once('functions.php');
$decode = htmlspecialchars_decode(base64_data_decode($_GET['d']));
$post=explode('=>',$_POST['select']);
$url = preg_replace("/\/$/","",$post[0]);
$name=$post[1]; 

	if (preg_match("/^mms:\/\//", $url) or preg_match("/.asx$/", $url)) {
	  $type= 'type="audio/wma"';
	  $steam= '';
	}
	
	elseif (preg_match("/[)]$/", $url) or preg_match("/.mp3$/", $url)) {
	  $type= 'type="audio/mp3"';
	  $steam= '';
	  $url= preg_replace('/^\(|\)$/','',$url);
	  $url= preg_replace("/\/$/","",$url);	  
	}
	
	else {
	  $type= 'type="audio/mp3"';
	  $steam= "/;stream.mp3";	  
	}
?>

<?php echo "<p>Now Playing: <b>".$name."</b></p>"?>
<script src="asset/jquery.js"></script>	
<script src="asset/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="asset/mediaelementplayer.min.css" />

<audio src="<?php echo $url.$steam; ?>" <?php echo $type; ?>  autoplay="true" fullscreen="false" loop="true" width="98%">		
</audio>

<script type='text/javascript'>
$('audio,video').mediaelementplayer({
audioWidth: '100%',
audioHeight: 30,
features: ['playpause','current','volume'],
enableAutosize: true,
enablePluginDebug: false,
pluginPath: 'asset/',
flashName: 'flashmediaelement.swf',
silverlightName: 'silverlightmediaelement.xap',
plugins: ['flash','silverlight']

});
</script>
</p> <p>
<form id="radio" name="form1" method="post" action="">
  <p>
    <label for="select"></label>
    <select name="select" id="select" class="form-control" onchange='this.form.submit()'>
      <option>Select any Channel</option>
      <?php echo $decode;?>
    </select>
  </p> <p>
     <noscript> <input type="submit" class="btn btn-primary" name="button" id="button" value="Play" /></noscript>
  </p>
</form>
