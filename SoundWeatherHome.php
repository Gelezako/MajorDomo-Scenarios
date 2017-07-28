// Блок логики домашних датчиков микроклимата

if($params['place']=='')$params['place']='квартире';

	    //вычисление окончание слова "градус" для влажности
	function degree($tempw){
      if($tempw >= 11 and $tempw <= 14){
      $degree=" градусов ";
      }
      else{

      if($tempw > 9){
      $tempw=$tempw%10;
      }

      if($tempw == 0 or $tempw >= 5 and $tempw <= 9){
      $degree= градусов ; }
      if($tempw == 1){
      $degree= градус ; }
      if($tempw >= 2 and $tempw <= 4){
      $degree= градуса ; }
      }
     return $degree;
    }

//вычисление окончание слова "процент" для влажности
	function humidity($tempw2){
          if($tempw2 >= 11 and $tempw2 <= 14){
          $tempcels=" процентов ";
          }
          else{

          while ($tempw2 > 9){
          $tempw2=$tempw2%10;
          }

         if($tempw2 == 0 or $tempw2 >= 5 and $tempw2 <= 9){
         $tempcels= процентов ; }
         if($tempw2 == 1){
         $tempcels= процент ; }
         if($tempw2 >= 2 and $tempw2 <= 4){
         $tempcels= процента ; }
         }
     return $tempcels;
    }

if((string)$params['weather']===(string)"температруа")
     	say("Сейчас в ".$params['place']." ".gg("Kitchen.Temperature")." ".degree(gg('Kitchen.Temperature'))." тепла.",2);

if((string)$params['weather']===(string)"влажность")
     	say("Сейчас в ".$params['place']." влажность ".gg("Kitchen.Humidity")." ".humidity(gg('Kitchen.Humidity')),2);
