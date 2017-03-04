// $params['date-time'] (ex 'сегодня');
// $params['date'] (ex '	2017-03-06');
// $params['films'] (ex 'imax');


//узнаём дату
if($params['date-time']=="сегодня") $date1=date("Y-m-d");
else if($params['date-time']=="завтра") $date1=date("Y-m-d", strtotime("+1 day"));
else if($params['date-time']=="послезавтра") $date1=date("Y-m-d", strtotime("+2 day"));
//else try{$date1=strtotime(DateTime::createFromFormat(DateTime::W3C, $params['date'])->format('Y-m-d H:i:s'));}
//catch (Exception $e){}
else if($params['date']!='')$date1=$params['date'];
else say("Не поняла на когда",2);

say("дата 1 ".$date1,2);

//узнаём технологию фильма
$technology2='';
if($params['films']=='4dx') $technology2='4dx-3d';
else if($params['films']=='imax') {$technology2='imax-3d';}

$url="http://planetakino.ua/kharkov/showtimes/xml/";
$data = simplexml_load_file($url);
$films= array();
       foreach ($data->showtimes->day->show as $show){
           if(substr($show['full-date'], 0, 10)==$date1 and $show['technology']==$params['films'] or $show['technology']==$technology2){
                    foreach ($data->movies->movie as $movie) {
                        if((string)$movie['id']==(string)$show['movie-id']){
                            $films[] = "Фильм ".$movie->title.".   ";
                           // echo "Фильм ".$movie->title." по технологии ".$show['technology']." ".$show['movie-id']." показывается в ".$show['full-date']."<br>";
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

