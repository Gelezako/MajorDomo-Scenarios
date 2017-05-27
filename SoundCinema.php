/**
* Сценарий для Majordomo
* Голосовые команды и озвучивание расписания фильмов в кинотеатрах planetakino.ua
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://blog.gelezako.com (c)
* @version 0.1 ([Mar 03, 2017])
**/
// $params['date-time'] (ex 'сегодня');
// $params['date'] (ex '2017-03-06');
// $params['films'] (ex 'imax');
// $params['time-period'] (ex 'днём, вечером, утром');
// $params['time']

//узнаём дату
if($params['date']!='')$date1=$params['date'];
//else if($params['date-time']=="сегодня") $date1=date("Y-m-d");
//else if($params['date-time']=="завтра") $date1=date("Y-m-d", strtotime("+1 day"));
//else if($params['date-time']=="послезавтра") $date1=date("Y-m-d", strtotime("+2 day"));


//узнаём часовой диапазон дня
//$time[0] - начало периода, $time[1] - конец периода
if($params['time']!='') {$time[0]=$params['time']; $time[1]="23:59:59";}
else $time[0]='';
if($params['time-period']!='') $time = explode('/', $params['time-period']);
else $time[0]='';

if($time[0]=='00:00:00')$time[1]="00:00:01";
if($time[1]=='00:00:00')$time[1]="23:59:59";

//узнаём технологию фильма, 2d и 3d приходят изначально в правильном формате
$technology2='';
if($params['films']=='4dx') $technology2='4dx-3d';
else if($params['films']=='imax') {$technology2='imax-3d';}
else if($params['films']=='Cinetech+3D') {$technology2='4dx-3d';}

$url=gg('City.URL');
$data = simplexml_load_file($url);

if(!empty($data)){
$films= array();//массив для названий фильмов
foreach ($data->showtimes->day as $day){ //ищем все дни проката
    if($day['date']==$date1){ // находим наш день
        foreach ($day->show as $show){
         //находим нашу технологию
            if(date_format(date_create_from_format('Y-m-d H:i:s',$show['full-date']),'Y-m-d')==$date1
             and $show['technology']==$params['films']
             or $show['technology']==$technology2){
                   foreach ($data->movies->movie as $movie) {
                   //находим название фильма в диапазоне времени если он задан
                                if((string)$movie['id']==(string)$show['movie-id'] and $time[0]=='')
                                      $films[] = "Фильм : ".$movie->title.". ";                             
                                   else if((string)$movie['id']==(string)$show['movie-id'] and $time[0]!='' and strtotime($show['time'])>=strtotime($time[0]) and strtotime($show['time'])<=strtotime($time[1])){
                              		 $films[] = "Фильм : ".$movie->title.". "; 
                                }
                            	
                            }
                        }  
            
        }
    }
}

  if(!empty($films)){
		$st = implode(",", array_unique($films));
        $st = str_replace('і', 'и', $st);
        $st = str_replace('І', 'И', $st);
        $st = str_replace('ґ', 'г', $st);
        $st = str_replace("'", 'ь', $st);
        $st = str_replace('е', 'э', $st);
        $st = str_replace('є', 'е', $st);
		$st = str_replace('Фыльм', 'Фильм', $st);
		say($st,2);
  }
 else if($params['films']!='' and $params['date']!='')
  say("Уже нет фильмов на эту дату. Возможно идут фильмы в других залах, к примеру в 2D.",2);
}
else say("Я не смогла загрузить данные",2);

