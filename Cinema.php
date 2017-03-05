/**
* Сценарий для Majordomo
* Голосовые команды и озвучивание расписания фильмов в кинотеатрах planetakino.ua
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://blog.gelezako.com (c)
* @version 0.1 ([Mar 03, 2017])
**/


// $params['date-time'] (ex 'сегодня');
// $params['date'] (ex '	2017-03-06');
// $params['films'] (ex 'imax');
// $params['time-period'] (ex 'днём, вечером, утром');

//узнаём дату
if($params['date-time']=="сегодня") $date1=date("Y-m-d");
else if($params['date-time']=="завтра") $date1=date("Y-m-d", strtotime("+1 day"));
else if($params['date-time']=="послезавтра") $date1=date("Y-m-d", strtotime("+2 day"));
//else try{$date1=strtotime(DateTime::createFromFormat(DateTime::W3C, $params['date'])->format('Y-m-d H:i:s'));}
//catch (Exception $e){}
else if($params['date']!='')$date1=$params['date'];
else say("Не поняла на когда ",2);

//узнаём часовой диапазон дня
if($params['time-period']!='')$params['time-period']=$time;
$time = explode('/', $time); //$time[0] - начало периода, /$time[1] - конец периода

//узнаём технологию фильма
$technology2='';
if($params['films']=='4dx') $technology2='4dx-3d';
else if($params['films']=='imax') {$technology2='imax-3d';}

$url="http://planetakino.ua/kharkov/showtimes/xml/";
$data = simplexml_load_file($url);

if($data){
$films= array();//массив для названий фильмов
foreach ($data->showtimes->day as $day){ //ищем все дни проката
    if($day['date']==$date1){
        foreach ($day->show as $show){
            if(date_format(date_create_from_format('Y-m-d H:i:s',$show['full-date']),'Y-m-d')==$date1
             and $show['technology']==$params['films']
             or $show['technology']==$technology2){       
                        foreach ($data->movies->movie as $movie) {     
                            if((string)$movie['id']==(string)$show['movie-id']){
                             	if($params['time-period']!="" and (int)strtotime($show['time'])>=(int)strtotime($time[0])and (int)strtotime($show['time'])<=(int)strtotime($time[1])){
                              		 $films[] = "Фильм: ".$movie->title." в ".$show['time'];
                             	}
                             	else $films[] = "Фильм: ".$movie->title." в ".$show['time'];
                            }
                        }  
            }
        }
    }
}


		$st = implode(",", array_unique($films));
        $st = str_replace('и', 'ы', $st);
        $st = str_replace('і', 'и', $st);
        $st = str_replace('І', 'И', $st);
        $st = str_replace('ґ', 'г', $st);
        $st = str_replace('ґ', 'г', $st);
        $st = str_replace("'", 'ь', $st);
        $st = str_replace('е', 'э', $st);
        $st = str_replace('є', 'е', $st);
		$st = str_replace('Фыльм', 'Фильм', $st);
	say($st,2);
 }
else say("Я не смогла загрузить данные",2);

