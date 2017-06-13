<? php

/**
SoundWeather
*
* @author Alex Sokolov <admin@gelezako.com>
* @version 0.2 ([10.06.2016])

Сценарий для Majordomo (majordomo.smartliving.ru) на основе данных из плагина получения информации о погоде openweather. Перед применением скрипта установить плагин openweather. 
*/

include_once(DIR_MODULES . 'app_openweather/app_openweather.class.php');
    $openweather = new app_openweather();
    $openweather->get_weather(gg('ow_city.id'));
    
    if((string)$params['date-period']===(string)"" or (string)$params['date-period']===(string)"сегодня"  or (string)$params['date-period']===(string)"сейчас"){$temp="ow_fact.temperature";$humidity="ow_fact.humidity";$wind="ow_fact.wind_speed";$weather_type="ow_fact.weather_type";}
    if((string)$params['date-period']===(string)"завтра"){$temp="ow_day1.temperature";$humidity="ow_day1.humidity";$wind="ow_day1.wind_speed";$weather_type="ow_day1.weather_type";}
    if((string)$params['date-period']===(string)"послезавтра"){$temp="ow_day2.temperature";$humidity="ow_day2.humidity";$wind="ow_day2.wind_speed";$weather_type="ow_day2.weather_type";}

    //вычисление окончание слова "градус" для температуры
	function degree($temp){
      $tempw=round(gg($temp));
      if($tempw >= 11 and $tempw <= 14){
      $degree=" градусов ";
      }
      else{

      while ($tempw > 9){
      $tempw=$tempw-10;
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
    //$tNew = abs((float)getGlobal('ow_fact.temperature'));

	//вычисление окончание слова "процент" для влажности
	function humidity($humidity){
          $tempw2=round(gg($humidity));
          if($tempw2 >= 11 and $tempw2 <= 14){
          $tempcels=" процентов ";
          }
          else{

          while ($tempw2 > 9){
          $tempw2=$tempw2-10;
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
	
	//давление
    $pressure=(float)gg("ow_fact.pressure_mmhg");
    if ($pressure<728) {
     $stp=" Атмосферное давление пониженное. ";
    } elseif ($pressure>768) {
     $stp=" Атмосферное давление повышенное. ";
    } else {
     $stp=" Атмосферное давление нормальное. ";
    }
	
	//ветер
    $WindSpeed=(float)gg("ow_fact.wind_speed");
    if ($WindSpeed<1) {
     $stw=" Ветра нет.";
    } elseif ($WindSpeed<5) {
     $stw.=" Ветер слабый.";
    } elseif ($WindSpeed<10) {
     $stw=" Ветер сильный.";
    } elseif ($WindSpeed<15) {
     $stw=" Ветер очень сильный.";
    } else {
     $stw=" Ветер капец какой сильный ";
    }
	
	if((string)$params['weather']===(string)"погода" and $params['WeatherType']==""){
         $status.="Погода в ".gg("ow_city.name")." на данный момент: ".gg("ow_fact.weather_type").". "." Температура: ".round(gg("ow_fact.temperature"))."  ".degree($temp)." цельсия. "." Относительная влажность: ".round(gg("ow_fact.humidity"))." ".humidity($humidity).". ".$stp.$stw;
         say($status,2);
    }

	elseif((string)$params['WeatherType']===(string)"тепло" and gg($temp)>24){
        say("Да, ".$params['date-period']." на улице тепло. Можно идти в шортах и футболке. Не забудь взять солнечные очки.",2);
        if((string)gg($weather_type)===(string)"пасмурно" and gg($humidity)>85) //влажность
      		say("И скорей всего будет дождь если уже не идёт.",2);
     	if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }
    

	elseif((string)$params['WeatherType']===(string)"тепло" and gg($temp)>0 and gg($temp)<25){
         say($params['date-period']." не очень тепло, на улице достаточно прохладно.",2);
         if((string)gg($weather_type)===(string)"пасмурно" and gg($humidity)>85) //влажность
      		say("И скорей всего будет дождь если уже не идёт.",2);
     	if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }

	elseif((string)$params['WeatherType']===(string)"холодно" and gg($temp)>25){
     	say("Нет, ".$params['date-period']." на улице жара, не забудь взять солнечные очки.",2);
     	if((string)gg($weather_type)===(string)"пасмурно" and gg($humidity)>85) //влажность
      		say("Но скорей всего будет дождь если уже не идёт. Возьми зонтик.",2);
        if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }

	elseif((string)$params['WeatherType']===(string)"холодно" and gg($temp)>0 and gg($temp)<25){
        say("Да, ".$params['date-period']." на улице достаточно прохладно и ".gg($weather_type).". Накинь что-нибуть сверху.",2);
     	if((string)gg($weather_type)===(string)"пасмурно" and gg($humidity)>85) //влажность
      		say("И скорей всего будет дождь если уже не идёт. Возьми зонтик.",2);
        if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }

	elseif((string)$params['WeatherType']==(string)"холодно" and gg($temp)>-10 and gg($temp)<1){
        say("Да, ".$params['date-period']." на улице небольшой мороз и ".gg($weather_type). ". Одевайся теплее.",2);
        if((string)gg($weather_type)==(string)"пасмурно" and gg($humidity)>85) //влажность
      		say("И скорей всего будет снег если уже не идёт.",2);
        if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }

	elseif((string)$params['WeatherType']===(string)"холодно" and gg($temp)<-11){
        say("Да, ".$params['date-period']." на улице мороз и ".gg($weather_type)." Тёплая шуба не помешает.",2);
        if(gg($weather_type)=="пасмурно" and gg($humidity)>85) //влажность
      		say("И скорей всего будет снег если уже не идёт.",2);
        if(gg($wind)>10 and gg($wind)<15)say(" И ещё меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say(" И ещё поднялся сильный ветер.",2);
        else if(gg($wind)>21)say(" Фигачит сильный ветер.",2);
    }

	if((string)$params['WeatherType']===(string)"ветрено"){
        if(gg($wind)<10)say("Нет, ".$params['date-period']." ветра почти нет.",2);
     	if(gg($wind)>=10 and gg($wind)<15)say("Да, ".$params['date-period']." меного дует ветер.",2);
        else if(gg($wind)>16 and gg($wind)<20)say("Да, ".$params['date-period']." поднялся сильный ветер.",2);
        else if(gg($wind)>21)say("Да, ".$params['date-period']." фигачит сильный ветер.",2);
    }

	if((string)$params['WeatherType']===(string)"пасмурно"){
        if((string)gg($weather_type)===(string)"пасмурно")say("Да, ".$params['date-period']." на улице пасмурно.",2);
        else say("Нет, на улице ".gg($weather_type),2);     
    }

	if((string)$params['WeatherType']===(string)"ясно"){
        if((string)gg($weather_type)===(string)"ясно")say("Да, ".$params['date-period']." на улице ясно.",2);
        say("Нет, на улице ".gg($weather_type),2);
    }

	if((string)$params['WeatherType']===(string)"влажно")say($params['date-period']." влажность на улице ".gg($humidity)." ".humidity($humidity),2);

	
	if((string)$params['WeatherType']===(string)"гроза" or (string)$params['WeatherType']===(string)"дождь"){
     	if(gg("ow_fact.weather_type")==="гроза" or gg("ow_fact.weather_type")==="дождь")
     	say("Да, на улице идёт ".gg("ow_fact.weather_type"),2);
     	else say("Нет, на улице нет осадков.",2);
    }

