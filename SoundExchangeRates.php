/*
* SoundExchangeRates.php
* @author Alex Sokolov <admin@gelezako.com>
* @copyright Alex Sokolov http://www.blog.gelezako.com (c)
* @version 0.1
*/


// определяем падеж слова
function padej($kop,$valuta){
 if ($valuta=="gr" and $kop=="2" or $kop=="3" or $kop=="4") return "гривны";
 else if($valuta=="gr") return "гривен";
 else if($valuta=="rub"and $kop=="1") return "рубль";
 else if($valuta=="rub"and $kop=="2" or $kop=="3" or $kop=="4") return "рубля";
 else if($valuta=="rub") return "рублей";
}

$eurob=(string)gg("exchange_rate.eurobuy");
$pieces_eb = explode(".", $eurob);
$euros=(string)gg("exchange_rate.eurosale");
$pieces_es = explode(".", $euros);

$usdb=(string)gg("exchange_rate.usdbuy");
$pieces_ub = explode(".", $usdb);
$usds=(string)gg("exchange_rate.usdsale");
$pieces_us = explode(".", $usds);

$rurd=(string)gg("exchange_rate.dollarrur");
$pieces_rd = explode(".", $rurd);

$rure=(string)gg("exchange_rate.eurorur");
$pieces_re = explode(".", $rure);

$eurob*=10;
$euros*=10;
$usdb*=10;
$usds*=10;
$rurb*=10;
$rurs*=10;

//если валюта по умолчанию не указана, то использовать гривну
if ($params['Currency1']=="") {$params['Currency1']="гривна";$params['number']=1;}

//для гривны
if($params['Currency'] == 'евро' and $params['Currency1'] == '' and $params['number'] == '') say("За 10 евро ".$euros." ".padej($pieces_es[1],"gr"),2);
else if($params['Currency'] == 'доллара' and $params['Currency1'] == '' and $params['number'] == '') say("За 10 долларов ".$usds." ".padej($pieces_us[1],"gr"),2);
else if($params['Currency'] == 'рубль' and $params['Currency1'] == '' and $params['number'] == '') say("За 10 рублей ".$rurs." ".padej($pieces_rs[1],"gr"),2);

// вычисляем доллар - гривна(рубль)
else if($params['Currency'] == 'доллар' or $params['Currency'] == 'доллара' or $params['Currency'] == 'долларов'){
 	if($params['Currency1'] == 'гривна' or $params['Currency1'] == 'гривнах'){
      $cur=gg('exchange_rate.usdsale')*$params['number']." ".padej($pieces_us[1],"gr");
      say($cur,2);
	}
  	else if($params['Currency1'] == 'рубль' or $params['Currency1'] == 'рублях'){
      $cur=gg('exchange_rate.dollarrur')*$params['number']." ".padej($pieces_rd[1],"rub");
      say($cur,2);
	}
}

// вычисляем евро - гривна(рубль)
	else if($params['Currency'] == 'евро'){
 	if($params['Currency1'] == 'гривна' or $params['Currency1'] == 'гривнах'){
      $cur=gg('exchange_rate.eurosale')*$params['number']." ".padej($pieces_es[1],"gr");
      say($cur,2);
	}
 	 else if($params['Currency1'] == 'рубль' or $params['Currency1'] == 'рублях'){
      $cur=gg('exchange_rate.eurorur')*$params['number']." ".padej($pieces_re[1],"rub");
      say($cur,2);
	}
}

// вычисляем рубль - гривна
else if($params['Currency'] == 'рубль' or $params['Currency'] == 'рублей'){
 	if($params['Currency1'] == 'гривна' or $params['Currency1'] == 'гривнах'){
     $cur=gg('exchange_rate.rursale')*$params['number']." ".padej($pieces_rs[1],"gr");
     say($cur,2);
	}
}

// вычисляем гривна - евро
     else if($params['Currency1'] == 'евро' and $params['Currency'] == 'рубль'){
               $cur=(float)$params['number']/gg('exchange_rate.eurosale');
                $cur=round($cur,2)." ".$params['Currency1'];
                say($cur,2);
     }



// вычисляем гривна(рубль) - доллар
	else if($params['Currency1'] == 'доллар'){
 	if($params['Currency'] == 'гривна'){
      $cur=round((float)$params['number']/gg('exchange_rate.usdsale'),2)." ".$params['Currency1'];
      say($cur,2);
	}
 	else if($params['Currency'] == 'рубль' or $params['Currency1'] == 'рублей'){
      $cur=round((float)$params['number']/gg('exchange_rate.dollarrur'),2)." ".$params['Currency1'];
      say($cur,2);
	}
}


else if($params['Currency'] == 'все валюты' or $params['Currency'] == 'всех валют')
$currency.="Курс валют: за 10 евро. Покупка ".$eurob." ".padej($pieces_eb[1],"gr").", продажа ".$euros." ".padej($pieces_es[1],"gr")." . За 10 долларов: покупка ".$usdb." ".padej($pieces_ub[1],"gr")." . Продажа ".$usds." ".padej($pieces_us[1],"gr");
say($currency,2);
