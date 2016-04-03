<?php
/**
 * @package    Hoicoi Radio
 * @subpackage default
 * @author     Jibon Lawrence Costa
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
JHtml::_('jquery.framework');
JHtml::script('modules/mod_hoicoi_radio/assets/mediaelement-and-player.min.js');
JHtml::stylesheet('modules/mod_hoicoi_radio/assets/mediaelementplayer.min.css');
$player = JUri::base() . "modules/mod_hoicoi_radio/tmpl/popup.php?url=" . JUri::base();
?>
<div id="hoicoiRadioArea" class="hoicoiRadio_<?php echo $params->get('moduleclass_sfx'); ?>">
    <div id="hoicoiRadiostatus"></div>
    <p></p>

    <div id="hoicoiRadioPlayer">
        <audio id="hoicoiRadio" width="100%" src=".mp3" ></audio>
    </div>

    <p></p>
    <div id="hoicoiRadioOptions">
        <select id ="hoicoiRadioChannels">
            <option>Select one</option>
            <?php echo $options; ?>
        </select>
    </div>
    <?php if ($params->get('popup')) { ?>
        <p><a href="javascript: void(0)" id="popupPlay">Play Radio in Popup Window </a></p>
    <?php } ?>
</div>

<script type="text/javascript">
    var player, nowPlay = " ";
    jQuery("document").ready(function ($) {
        player = new MediaElementPlayer('#hoicoiRadioArea #hoicoiRadio', {
            plugins: ['flash', 'silverlight'],
            features: ['playpause', 'progress', 'volume'],
            //if success
            success: function (mediaElement, domObject) {

                mediaElement.addEventListener('loadeddata', function (e) {
                    $("#hoicoiRadioArea #hoicoiRadiostatus").html("<b>Now Playing: </b>" + nowPlay);

                }, false);
            },
            // fires when a problem is detected
            error: function (e) {
                $("#hoicoiRadioArea #hoicoiRadiostatus").html("<p style='color: red'>Error !!</p>");
            }
        });

        player.load();
        player.pause();

        $("#hoicoiRadioArea #hoicoiRadioChannels").change(function () {
            $("#hoicoiRadioArea #hoicoiRadiostatus").html("<img alt='loading' src='<?php echo JUri::base() ?>modules/mod_hoicoi_radio/assets/loading.gif'><img/>");
            player.setSrc(decodeBase64($(this).val()));
            player.load();
            player.play();
            nowPlay = $(this).find('option:selected').text();

        });

        $("#hoicoiRadioArea #popupPlay").click(function () {
            popup('<?php echo $player ?>');
        });

        function decodeBase64(s) {
            var e = {}, i, b = 0, c, x, l = 0, a, r = '', w = String.fromCharCode, L = s.length;
            var A = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
            for (i = 0; i < 64; i++) {
                e[A.charAt(i)] = i;
            }
            for (x = 0; x < L; x++) {
                c = e[s.charAt(x)];
                b = (b << 6) + c;
                l += 6;
                while (l >= 8) {
                    ((a = (b >>> (l -= 8)) & 0xff) || (x < (L - 2))) && (r += w(a));
                }
            }
            return r;
        }
        function popup(url) {

            var width = 300;
            var height = 200;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            var params = 'width=' + width + ', height=' + height;
            params += ', top=' + top + ', left=' + left;
            params += ', directories=no';
            params += ', location=no';
            params += ', menubar=no';
            params += ', resizable=no';
            params += ', scrollbars=no';
            params += ', status=no';
            params += ', toolbar=no';
            newwin = window.open(url, 'windowname5', params);
            if (window.focus) {
                newwin.focus()
            }
            return false;
        }
    });

</script>