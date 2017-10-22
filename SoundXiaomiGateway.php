/**
* Сценарий для Majordomo
* Голосовой управление ночником Xiaomi Gateway
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://blog.gelezako.com (c)
**/

if($params['color']=="синий")$color="0010ff";
if($params['color']=="красный")$color="ff000e";
if($params['color']=="белый")$color="fffff3";
if($params['color']=="жёлтый" or $params['color']=="желтый")$color="ffff2d";
if($params['color']=="фиолетовый")$color="ff00f3";
if($params['color']=="зелёный" or $params['color']=="зеленый")$color="00ff25";

//если указан цвет
if($params['state']=="включить" or $params['state']=="врубить" or $params['state']=="вруби" and $params['color']!="") {sg("XiRgb01.color",$color);say("цвет установлен",2);}
//включение
if($params['state']=="выключить" or $params['state']=="вырубить" or $params['state']=="выруби" or $params['state']=="потуши" or $params['state']=="потушить") {sg("XiRgb01.brightness",0);say("выключено",2);}

//если указана только освещённость
if($params['number']!="" and $params['color']=="") {sg("XiRgb01.brightness",$params['number']);say("яркость установлена",2);}
//если указана освещённость и цвет
if($params['state']=="включить" and $params['number']!="" and $params['color']!="") {sg("XiRgb01.color",$color);sg("XiRgb01.brightness",$params['number']);say("готово",2);}

if($params['state']=='' and $params['illumination']=="освещённость" or $params['illumination']=="освещенность" or $params['illumination']=="освещение" and $params['number']=="") say("Сейчас освещённость ".gg("Sensor_light01.status")." люменов",2);
if($params['any']=="диско" and $params['any']=="дискотека"){runScript("disco");say("готово",2);}
