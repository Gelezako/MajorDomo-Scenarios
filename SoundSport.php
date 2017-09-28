/**
* SoundSport.php
* @package project
* @author Alex Sokolov <admin@gelezako.com>
* @copyright http://blog.gelezako.com (c)
* @version 0.1 ([Sep 21, 2017])
*/

if($params['exercises']=='пресс' or $params['exercises']=='прессу'){sg("Press.Quantity",$params['number']);say("Готово, записано ".$params['number'],2);}
if($params['exercises']=='отжался' or $params['exercises']=='отжимание' or $params['exercises']=='отжиманию'){sg("Pushup.Quantity",$params['number']);say("Готово, записано ".$params['number'],2);}
if($params['exercises']=='подтянулся' or $params['exercises']=='подтягиванию'){sg("Pullup.Quantity",$params['number']);say("Готово, записано ".$params['number'],2);}
