// $params['color'] (ex 'синий');

if($params['color']=="синий"){$color="0010ff";sg("XiRgb01.color","0010ff");}
if($params['color']=="красный") {$color="ff000e";sg("XiRgb01.color","ff000e");}
if($params['color']=="белый") {$color="fffff3";sg("XiRgb01.color","fffff3");}
if($params['color']=="жёлтый" or $params['color']=="желтый") {$color="ffff2d";sg("XiRgb01.color","ffff2d");}
if($params['color']=="фиолетовый") {$color="ff00f3";sg("XiRgb01.color","ff00f3");}
if($params['color']=="зелёный" or $params['color']=="зеленый") {$color="00ff25";sg("XiRgb01.color","00ff25");}

if($params['number']!="")sg("XiRgb01.brightness",$params['number']);
if($params['state']=="включить" or $params['state']=="врубить" or $params['state']=="вруби") sg("XiRgb01.brightness",100);
if($params['state']=="выключить" or $params['state']=="вырубить" or $params['state']=="выруби" or $params['state']=="потуши" or $params['state']=="потушить") sg("XiRgb01.brightness",0);

if($params['state']=="включить" and $params['number']!="") sg("XiRgb01.brightness",$params['number']);
if($params['state']=="включить" and $params['number']!="" and $params['color']!="") {sg("XiRgb01.brightness",$params['number']); sg("XiRgb01.color",$color);}
if($params['state']=="врубить" and $params['number']!="") sg("XiRgb01.brightness",$params['number']);
if($params['state']=="вруби" and $params['number']!="") sg("XiRgb01.brightness",$params['number']);
if($params['color']=="красный" and $params['number']!="") {sg("XiRgb01.color","ff000e"); sg("XiRgb01.brightness",$params['number']);say("два",2);}
if($params['color']=="белый" and $params['number']!="") {sg("XiRgb01.color","fffff3"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="желтый" and $params['number']!="") {sg("XiRgb01.color","ffff2d"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="жёлтый" and $params['number']!="") {sg("XiRgb01.color","ffff2d"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="фиолетовый" and $params['number']!="") {sg("XiRgb01.color","ff00f3"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="зеленый" and $params['number']!="") {sg("XiRgb01.color","00ff25"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="зелёный" and $params['number']!="") {sg("XiRgb01.color","00ff25"); sg("XiRgb01.brightness",$params['number']);}
if($params['color']=="синий" and $params['number']!="") {sg("XiRgb01.color","0010ff"); sg("XiRgb01.brightness",$params['number']);}
if($params['illumination']=="освещённость" or $params['illumination']=="освещенность" or $params['illumination']=="освещение") say("Сейчас освещённость ".gg("Sensor_light01.status")." люменов",2);
if($params['any']=="диско" and $params['any']=="дискотека"){runScript("disco");say("ок",2);}
