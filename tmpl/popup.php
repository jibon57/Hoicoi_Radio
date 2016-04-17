<?php
/**
 * @package    Hoicoi Radio
 * @author     Jibon Lawrence Costa
 * @email      jiboncosta57@gmail.com
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
if (!isset($_GET['url'])) {
    exit("This link won't work here !!");
} else {
    $url = $_SERVER[HTTP_HOST] . $_SERVER['REQUEST_URI'];
    $url = str_replace("modules/mod_hoicoi_radio/tmpl/popup.php?url=" . $_GET['url'], "", $url);

    $clean = array('http://', 'https://', 'www');
    foreach ($clean as $d) {
        if (strpos($_GET['url'], $d) === 0) {
            $getUrl = str_replace($d, "", $_GET['url']);
        }
    }
    if ($getUrl !== $url) {
        exit("This link won't work here !!");
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
    <!--
    * @package    Hoicoi Radio
    * @author     Jibon Lawrence Costa
    * @email      jiboncosta57@gmail.com
    * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    -->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title></title>
        <script src="<?php echo $_GET['url'] ?>media/jui/js/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/mediaelement-and-player.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../assets/mediaelementplayer.min.css" type="text/css" />

    </head>

    <body>
        <div id="hoicoiRadioArea" class="hoicoiRadio">
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
        </div>

        <script type="text/javascript">
            var player, nowPlay = " ";

            jQuery("document").ready(function ($) {

                var request = {
                    'option': 'com_ajax',
                    'module': 'hoicoi_radio',
                    'url': '<?php echo $_GET["url"] ?>',
                    'format': 'json'
                };

                $.ajax({
                    type: 'POST',
                    data: request,
                    url: '<?php echo $_GET["url"] ?>',
                    success: function (response) {
                        if (response.data) {
                            $('#hoicoiRadioArea #hoicoiRadioChannels').append(response.data);
                        }

                    },
                    error: function (response) {

                    }
                });


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

                $("#hoicoiRadioArea #hoicoiRadioChannels").change(function () {
                    $("#hoicoiRadioArea #hoicoiRadiostatus").html("<img alt='loading' src='../assets/loading.gif'><img/>");
                    player.setSrc(decodeBase64($(this).val()));
                    player.load();
                    player.play();
                    nowPlay = $(this).find('option:selected').text();

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
            });

        </script>
    </body>
</html>
