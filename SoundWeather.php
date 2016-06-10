<? php

/**
SoundWeather
*
* @author Alex Sokolov <admin@gelezako.com>
* @version 0.1 ([10.06.2016])

Сценарий для Majordomo (majordomo.smartliving.ru) на основе данных из плагина получения информации о погоде openweather. Перед применением скрипта установить плагин openweather. 
*/
	//Температура
    $tempw=round(gg("ow_fact.temperature"));
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
    $tNew = abs((float)getGlobal('ow_fact.temperature'));

	//влажность
	$tempw2=round(gg("ow_fact.humidity"));
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
     $stw.=" Ветра нет.";
    } elseif ($WindSpeed<3) {
     $stw.=" Ветер слабый.";
    } elseif ($WindSpeed<6) {
     $stw.=" Ветер сильный.";
    } elseif ($WindSpeed<9) {
     $stw.=" Ветер очень сильный.";
    } else {
     $stw.=" Ожидается ураган ";
    }
	
	$status.="Сегодня ".gg("ow_fact.weather_type").". "." Температура: ".round(gg("ow_fact.temperature"))."  ".$degree." цельсия. "." Относительная влажность: ".round(gg("ow_fact.humidity"))." ".$tempcels.". ".$stp.$stw;
	say($status,1);
?>
