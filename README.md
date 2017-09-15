# SoundWeather
Сценарий для "Majordomo" (majordomo.smartliving.ru) на основе данных из плагина получения информации о погоде openweather. Перед применением скрипта установить плагин "openweather"  и "API.AI". Код добавить либо в раздел "Сценарии" либо "Шаблоны поведения". Так же для успешного озвучивания у вас должен быть установлен плагин" Windows TTS" для ОС Windows. А в настройках Windows
<br>
Control Panel\Ease of Access\Speech Recognition\Text to Speech
<br>
необходимо выбрать русский синтез речи. Если у вас нерусская ОС, то вам необходимо установить дополнительно русский синтез речи, готовый не идёт по--умолчанию в нерусской ОС Windows.
<br>Демонстрация применения и видео инструкция по настройке:
https://www.youtube.com/watch?v=4B4ImDR2st4


# SoundMusic
Голосовое управление музок, источник mixcloud, трубуется установка плагина
Демонстрация применения и видео инструкция по настройке:
https://www.youtube.com/watch?v=4B4ImDR2st4

# SoundExchangeRates
Сценарий для "Majordomo" (majordomo.smartliving.ru) Получает курсы валют покупки\продажи евро, доллар и рубль по отношению к гривне от API PrivatBank. А так же курсы валют евро, доллар по отношению к рублю Банка России.
Необходимо установить модуль: ExchangeRates<br>
https://github.com/Gelezako/MajorDomo-ExchangeRates<br>
И плагин API.AI<br>
После этого у объекта класса будет автоматически создано и инициализировано 6 свойств:
<br>
Rate.eurobuy<br>
Rate.eurosale<br>
Rate.usdbuy<br>
Rate.usdsale<br>
Rate.dollarrur<br>
Rate.eurorur<br>

Для того что бы данные обновлялись автоматически, необходимо в классе "Timer" открыть метод "onNewHour" и добавить в конец:
<br>
//проверяем изменение курса валют, вызываем сценарий<br>
runScript("ExchangeRates");
<br>
Название сценария должно совпадать с вызываемым в методе "onNewHour". Для хранения статистики изменения курса и построения графиков в класс "ExchangeRates" необходимо добавить свойства:<br>
eurobuy<br>
eurosale<br>
usdbuy<br>
usdsale<br>
Указать колличество дней для хранения значений курса.
Демонстрация применения и видео инструкция по настройке:
https://www.youtube.com/watch?v=wZSfGWjE6lc


# SoundCinema
Голосовые команды и озвучивание расписания фильмов в кинотеатрах planetakino.ua
Поддерживаемые команды:
 - Что сегодня (завтра, послезавтра) показывают в аймакс (2D,3D,4D)? (можнои спользовать: "сегодня", "завтра", "послезавтра" и тип фильма: "аймакс", "2D", "3D", "4D")
 - Что 5 марта показывают в аймакс (2D,3D,4D)? (использование дат, система автоматически определит текущий месяц)
 - Что завтра вечером показывают в аймакс (2D,3D,4D)? (в качестве временного периодна можнои спользовать "утром" или "вечером")
 
Плагин Majordomo для выбора города для которого нужно озвучивать фильмы в кинотеатре: https://github.com/Gelezako/MajorDomo-Cinema
Демонстрация применения и видео инструкция по настройке:
https://www.youtube.com/watch?v=EDtMvenQhYs&t=17s


# SoundYoutubeSearch
Сценарий для поиска клипов на Youtube.
Демонстрация применения и видео инструкция по настройке:
https://www.youtube.com/watch?v=6ggg7jzs8qQ

# SoundMQ2, SoundMQ135, SoundDHT22
Сбор данных с датчика газов, их анализ и голосовое оповещение о качестве воздуха в квартире
Ссылка на скетч для Arduino
https://github.com/Gelezako/MQ2-MQ135-DHT22-HC-SR501-MQTT-Ethernet-Majordomo

Демонстрация применения и видео инструкция по настройке
https://www.youtube.com/watch?v=mB0fdDYdvEI


# SoundBattLevel
На телефон необходимо установить Tasker и плагин к таскеру MQTT Publish Plugin https://play.google.com/store/apps/details?id=net.nosybore.mqttpublishplugin. Сделать настройки в Таскере как указано вот тут http://majordomo.smartliving.ru/Main/ScAndroidTasker, но вместо того что бы тправлять данные в модуль gps.phph необходимо настроить отправку данных на MQTT сервер с помощью плагина MQTT Publish Plugin. После этого в MajorDomo в модуле MQTT считать эти данные, связать их с вашими свойствами и использовать с сценарии для озвучивания уровня заряда в батарее.


Видео уроки по настройке плагинов и сценариев: https://www.youtube.com/playlist?list=PLYOYjvcehgZKWUxcNR25o37EdBGtX084E
