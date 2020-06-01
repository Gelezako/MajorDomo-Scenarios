/*
* SoundMQ2+MQ135.php
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://www.blog.gelezako.com (c)
* @version 0.1 ([May 23, 2017])
*/

if($params['gas']=="воздуха"){
 	if(gg("Kitchen.MQ2")<100) say("Качество воздуха отличное",2);
 	else if(gg("Smoke02.value")>100 and gg("Smoke02.value")<=200) say("Качество воздуха ".gg('Smoke01.value').", это среднее значение, не мешало бы проветрить",2);
 	else if(gg("Smoke02.value")>200) say("Качество воздуха ".gg('Smoke01.value').", это плохой воздух, нужно срочно проветрить",2);
}

if($params['gas']=="угарного газа"){
 	$gas="Уровень угарного газа ".gg("Kitchen.MQ135");
 	say("$gas",2);
     if(gg("Kitchen.MQ135")<80) say("Это в пределах нормы.",2);
     else if(gg("Kitchen.MQ135")>=80) say("Это за пределами нормы. Необходимо проветрить помещение.",2);
}

if($params['gas']=="углекислый" or $params['gas']=="углекислого"){
 	$gas="Уровень углекислого газа ".gg("Kitchen.MQ135");
 	say("$gas",2);
     if(gg("Kitchen.MQ135")<80) say("Это в пределах нормы.",2);
     else if(gg("Kitchen.MQ135")>=80) say("Это за пределами нормы. Необходимо проветрить помещение.",2);
}
