/**
* Сценарий для Majordomo
* Голосовые оповещение об уровне заряда батареи телефона
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://blog.gelezako.com (c)
* @version 0.1 ([Sep 14, 2017])
**/

// $params['battlevel'] (ex 'заряд');

//вычисление окончание слова "процент"
	function humidity($battlevel){
          if($battlevel >= 11 and $battlevel <= 14){
          $percent=" процентов ";
          }
          else{

          while ($battlevel > 9){
          $battlevel=$battlevel%10;
          }

         if($battlevel == 0 or $battlevel >= 5 and $battlevel <= 9){
         $percent= процентов ; }
         if($battlevel == 1){
         $percent= процент ; }
         if($battlevel >= 2 and $battlevel <= 4){
         $percent= процента ; }
         }
     return $percent;
    }
(int)$battlevel=gg("Alex.Battlevel");
say("Уровень заряда батареи телефона ".$battlevel." ".humidity($battlevel),2);

if($battlevel<=20)say("Батарею телефона немешало бы подзарядить",2);
