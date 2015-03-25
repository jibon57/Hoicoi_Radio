# Hoicoi Radio for Joomla
With this module you can add unlimited streaming mp3,mms,asx or any kinds of streaming radio station even can play your own mp3 songs. This module won't reload the full page but only the player so it's fast. It's very easy to install & configure. I used responsive MediaElement.js player with bootstrap cool CSS :). mms:// link also support but will need silverlight plugin installed. Popup playing function is added also.

Supported type: mp3,mms,asx or any kinds of streaming radio station or mp3 file.

For playing mms:// link you will need silverlight.

More here: https://extensions.hoicoimasti.com/8-joomla-extension/1-hoicoi-radio.html

<pre>
Troubleshooting & General Setup Questions:
--------------------------------------------
1. How I can add station ?
> From Joomla module manager find out “Hoicoi Radio” open it & add station name separating by comma (,). By the same time add station URL in URL textarea corresponding station name separated by comma (,). Change other module parameter.
2. mms:// station not playing in mobile what's the reason ?
> mms:// station need silverlight plugin. Silverlight is available for windows,Mac & linux not for Android. As I wasn't able to play mms station in my Android Device :P
3. How I will add m3u playlist ?
> m3u playlist can't be added directly. Download that file & open by notepad. You can see station list. Just add those link in module from Joomla back-end.
4. Can I add asx format directly ?
> Yes, you can add that format directly. If not working then open that file using notepad & try to add station manually.
5. Player not playing what I will do ?
> Sometime player don't work. You can use one tricks. If your station format is http://XX.XX.XX.XX:PPPP then make sure that the station don't have any mount point. Try to visit the url by your browser. If you see that the station has more then one mount point then put the URL in first bracket “()” . Let's assume one mount point is “/live” then URL for player will be (http://XX.XX.XX.XX:PPPP/live) . If station still not working then try with different browser or player link VLC or windows media player to make sure that the station is really working.
6. How I will play if the station has more then one mount point ?
> See answer 5
7. How I will add my own mp3 songs ?
> Make one folder inside Joomla instillation directory & upload mp3 files there. For example: I have one folder called “mp3” in “images” folder. So you can upload mp3 files from media manager or by FTP. Make sure that mp3 file's name don't have any space like : not amar bangla.mp3 (incorrect) but amar_bangla.mp3 (correct). After upload the link will be:
http://YOURDOMAIN/images/mp3/amar_bangla.mp3
At present mp3 playlist not support so you need to make separate link for every mp3 file.
</pre>
Still need help? Please write in forum: http://joomlacode.org/gf/project/hoicoi_radio/forum/
