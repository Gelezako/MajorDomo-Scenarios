/*
* music.php
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://www.blog.gelezako.com (c)
* @version 0.1
*/

if ($params['typemusic']=="транс")
getURL(BASE_URL.ROOTHTML.'apps/mixcloud.html?mode=playnow&terminal=MAIN&item_id=%2Finternationaldepartures%2Fshane-54-international-departures-361%2F',0);

else if($params['typemusic']=="чилаут")
getURL(BASE_URL.ROOTHTML.'apps/mixcloud.html?mode=playnow&terminal=MAIN&item_id=%2Feclectic-ladyland%2Fepisode-271-le-mix-lebowski-2%2F',0);

else if($params['typemusic']=="драм-н-бэйс" or $params['typemusic']=="драм")
getURL(BASE_URL.ROOTHTML.'apps/mixcloud.html?mode=playnow&terminal=MAIN&item_id=%2Fmotellacast%2Fdj-mocity-motellacast-e95-22-02-2017-special-guest-ez-riser%2F',0);
