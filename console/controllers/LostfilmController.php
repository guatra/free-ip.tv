<?php
namespace console\controllers;

use Yii;
use GuzzleHttp\Client; // подключаем Guzzle
use console\models\FullName;
use backend\models\Release;
use console\models\News;
use yii\helpers\Console;
use yii\imagine\Image;
use yii\helpers\Url;

class LostfilmController extends \yii\console\Controller
{
    /**
     * Update new release series from Lostfilm.tv
     * @param null $url
     */
    public function actionNew($url = null){
        $time_start = microtime(true);

        $url = "https://www.lostfilm.tv/new/";
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        //https://www.lostfilm.tv/series/?type=search&s=3&t=1
        $res = $client->request('GET', $url);
        // устанавливаем счётчик
        $i = 0;
        // создаём пустой массив
        $data=[];
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        // выполняем проход циклом по списку
        $row = $document->find("div.row");
        // выполняем проход циклом по списку
        foreach ($row as $elem) {
            //pq аналог $ в jQuery
            $pq = pq($elem);
            // id сериала
            $data_release_name = $pq->find('a:first')->attr('href');
            $release_name = explode("/", $data_release_name);
            $release_name = $release_name[2];
            //
            $lostfilm = FullName::find()
                ->select(['release_lostfilmid', 'release_lostfilm_alias', 'release_totalseasons']) //Запрашиваем id в лостфильм картотеке
//            ->where(['release_show' => 0])
//            ->where(['release_show' => 1, 'release_status' => 1]) //где статус снимается и показывать значение true
                ->where(['release_lostfilm_alias' => $release_name])
                // ->asArray()
                ->one(); // массив
            // TODO если нет то нужно внести в базу ( навсякий случай )
            $id = $lostfilm['release_lostfilmid'];
            // Имя русское сериала
            $name_ru = $pq->find('a > div.body > div.name-ru')->text();
            // имя английское
            $name_en = $pq->find('a > div.body > div.name-en')->text();
            //
            $title = $pq->find('.details-pane > .alpha:first')->text();
            //
            $season_series = $pq->find('.left-part')->text();
            if ($season_series) {
                $e = explode(" ", $season_series);
                $season = $e[0];
                $episode_e = $e[2];
            }
            // Делаем запрос к базе, на наличие
            $release_find_ru = Release::find()
                ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'ru-RU'])
                ->asArray()
                ->one();
            // Если эпизода нет, то делаем запрос к станице эпизода
            if (!$release_find_ru) {
                echo "Делаем запрос к странице эпизода\n";
                $episode_find = $this->getEpisode($release_name, $season, $episode_e);
//                $release_find_ru = $episode_find;
                // Время эпизода
                $runtime = $episode_find['runtime'];
                // Описание эпизода
                $plot = $episode_find['plot'];
                // Дата выхода эпизода
                $date_ru = $episode_find['date'];
                //
                $imagine_view_release_e = $episode_find['img'];
                //
                $url_release = $this->getUrl($id, $season, $episode_e);
                //
//                $this->stdout("Ищем в базе релиз\n", Console::FG_GREY);
//                $this->stdout("Начинаю запись в базу\n", Console::FG_GREY);
                $update_at = time();
                //

                $episode_article_key = Yii::$app->security->generateRandomString();
                //
                $this->stdout("Ищем в базе релиз\n", Console::FG_GREY);
                $this->stdout("Начинаю запись в базу\n", Console::FG_GREY);
                $episode = new Release();
                $episode->release_id = $id;
                $episode->episode_article_key = $episode_article_key;
                $episode->episode_url = $url_release;
                $episode->episode_title = $title;
                $episode->episode_season = $season;
                $episode->episode_season_number = $episode_e;
                $episode->episode_plot = $plot;
                $episode->episode_runtime = $runtime;
                $episode->episode_language = 'ru-RU';
                $episode->episode_released = $date_ru;
                $episode->save() ? $save = 1 : $save = 0;
                if ($save == 1) {
                    $this->stdout("УСПЕХ\n", Console::FG_GREEN);
                    $this->stdout("Русский релиз записан: Сериал " . $name_ru ." (". $name_en . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $title . "\n", Console::FG_RED);
//                    $this->getSend(
//                        "Вышел новый эпизод сериала " . $name_ru ." ",
//                        "Сериал " . $name_ru . " (". $name_en . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $title,
//                        "" . $season,
//                        "" . $episode_e,
//                        "" . $title,
//                        "" . $name_ru,
//                        "" . $episode_article_key);
                    $this->getNews(
                        $name_ru." (" . $name_en . "). " . $title . ". (Сезон " . $season . " Эпизод " . $episode_e . ")",
                        "" . $plot,
                        "series",
                        "/Images/" . $id . "/Posters/poster.jpg",
                        "series" ,
                        $date_ru,
                        $update_at,
                        $episode_article_key);
                    $structure = 'C:/xampp/htdocs/free-ip.tv/frontend/web/uploads/Images/'.$id.'/Posters/';
//                     $structure = '/Users/guatra/Projects/siteParse/frontend/web/uploads/Images/'.$id.'/Posters/';
                    if (file_exists($structure)) {
                        $this->stdout("Папка существует\n", Console::FG_GREEN);
                    } else {
                        mkdir($structure, 0777, true);
                    }

                    $this->stdout("*** ".$release_name." \n", Console::FG_RED);
                    // 715x330.JPEG(24-bit color) https://static.lostfilm.tv/Images/245/Posters/e_1_1.jpg
                    $this->saveImage($structure, $status = 'episode', $imagine_view_release_e, $id, $season, $episode_e);
                    $this->stdout("SAVE *** " . $imagine_view_release_e . " \n", Console::FG_RED);
                }
                if ($lostfilm->release_totalseasons !== (int)$season){
                    if ($lostfilm->release_totalseasons < (int)$season){
                        $find = FullName::findOne($id);
                        $find->release_totalseasons = $season;
                        $find->update() ? $save = 20  : $save = 10;
                        if ( $save == 20 ){
                            $this->stdout("Обновление количества сезонов на ".$season."\n", Console::FG_GREEN);
                            $this->getSend(
                                "Обновление количества сезонов сериала " . $name_ru ." на " . $season,
                                "Обновление количества сезонов сериала " . $name_ru ." на " . $season,
                                "" . $season,
                                "" . $episode_e,
                                "" . $title,
                                "" . $name_ru,
                                "" . $episode_article_key
                            );
                            //TODO Сбросить переменную и внести значение
                            $lostfilm->release_totalseasons = $season;
                        }
                    }

                }

            }
            else{
                // Если эпизод есть, проверяем наличие пыстых значений
                if (!$release_find_ru['episode_plot']){

                    $this->stdout("Сериал {$name_ru}, эпизод есть , проверяем наличие обновления описания\n", Console::FG_GREY);
                    $episode_find = $this->getEpisode($release_name, $season, $episode_e);
                    // Описание эпизода
                    $plot = $episode_find['plot'];
                    if ($plot){
                        $update_plot = Release::findOne($release_find_ru['id']);
                        $update_plot->episode_plot = $plot;
                        $update_plot->update() ? $this->stdout("Запись описания:\n" . $plot . "\n", Console::FG_RED) : 0;
                    }else{
                        $this->stdout("нечего нового\n", Console::FG_RED);
                    }
                }
            }
            // добавляем в массив
            //$data[$i] = ['des' => $details_channel];
            //$data[$i] = ['name_ru' => $name_ru, 'name_en' => $name_en, 'div'=> $title ];
            // увеличиваем счетчик
            //$i++;

        }
        echo "Закончили\n";
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $this->stdout("Ничего не делал $time секунд\n", Console::FG_RED);
    }



    /**
     * Update all series Lostfilm.tv with local databases
     */
    public function actionAll()
    {
        $time_start = microtime(true);
        $this->stdout("Обновляем ссылки по сериалам  ", Console::FG_GREEN);
        $this->stdout("LostFilm.tv\n", Console::FG_RED);
        $this->stdout("*****************************\n", Console::FG_RED);
        $this->stdout("Находим массив по сериалам\n", Console::FG_GREY);
        $url_find = FullName::find()
            ->select(['release_lostfilmid', 'release_lostfilm_alias', 'release_name_ru']) //Запрашиваем lostfilm_id в картотеке
//            ->where(['release_show' => 208])
            ->where(['release_lostfilmid' => 207])
//            ->where(['release_show' => 1, 'release_status' => 1, 'release_type' => 'series']) //где статус снимается и показывать значение true
//            ->orderBy(['id' => SORT_DESC])
            ->orderBy(['id' => SORT_ASC])

            ->all(); // массив
        $this->stdout("*****************************\n", Console::FG_GREEN);
        foreach ($url_find as $lostfilm) {
            // Алиас имени
            $release_name = $lostfilm->release_lostfilm_alias;
            $name = $lostfilm->release_name_ru;
            $this->stdout("Сериал ", Console::FG_GREEN);
            $this->stdout($name."(".$release_name.")\n", Console::FG_GREEN);
            $this->stdout("Начинаю перебирать массив\n", Console::FG_GREY);
            $this->stdout("Работаем с получиным массивом\n", Console::FG_GREY);
            $id = $lostfilm->release_lostfilmid;
            $this->stdout($id."\n", Console::FG_GREY);
            //
            $url = 'https://www.lostfilm.tv/series/' . $release_name . '/seasons/';
            //
            $this->stdout("Набираю обороты\n", Console::FG_GREY);
            // создаем экземпляр класса
            $client = new Client();
            // отправляем запрос к странице
            echo "Отправляем запрос к странице\n";
            $res = $client->request('GET', $url);
            echo "Устанавливаем счётчик i=0\n";
            // устанавливаем счётчик
            $i = 0;
            echo "Создаём пустой массив\n";
            // создаём пустой массив
            //$data = [];
            echo "Получаем данные между открывающим и закрывающим тегами body\n";
            // получаем данные между открывающим и закрывающим тегами body
            $body = $res->getBody();
            //
            echo "Подключаем phpQuery\n";
            $document = \phpQuery::newDocumentHTML($body);
            //
            echo "Находим блок серий\n";
            $movie_parts_list = $document->find("tr");
            $details = $document->find('div.title-block > .details-pane > .right-box')->text();
            $details = explode("Жанр:", $details);
            $plot = '';
            $save = '';
            //
            $this->stdout("Выполняем проход циклом по списку серий ".$release_name."\n", Console::FG_GREY);
            foreach ($movie_parts_list as $elem) {
                //pq аналог $ в jQuery
                $pq = pq($elem);
                //
                $url = $pq->find(".beta")->attr('onClick');
                $name_en = $pq->find(".gamma span.small-text")->text();
                $pq->find('td.gamma > div > span.gray-color2.small-text')->remove();
                //
                $name_ru = $pq->find("td.gamma > div")->text();;
                $name_ru = (string)trim($name_ru);
                //
                $season_series = $pq->find("td.beta")->text();

                if ( $season_series ) {
                    $e = explode(" ", $season_series);
                    $season = $e[0];
                    $episode_e = $e[2];
                }
                //
                //$url_plot_episode = 'https://www.lostfilm.tv/series/Fargo/season_'.$e[0].'/episode_'.$e[2].'/';


                $n = $pq->find('td.delta > span.gray-color2.small-text')->text();
                if ( !$n ) {
                    $n = $pq->find('td.delta > span.gray-color.small-text')->text();
                }
                $pq->find('td.delta > span.gray-color2.small-text')->remove();
                $pq->find('td.delta > span.gray-color.small-text')->remove();
                $d = $pq->find(".delta")->text();
//                if($d)
//                {
//                    $date_ru = explode(" ", trim($d));
//                    $date_ru = explode(".", $date_ru[1]);
//                    $date_ru = mktime(0, 0, 0, $date_ru[1], $date_ru[0], $date_ru[2]);
//                }
//                else {
//                    $date_ru = mktime(0, 0, 0, 1, 1, 2018);
//                }
                //$date_ru = null;
                $date_en = explode(" ", $n);
                if ( $name_ru !== null ) {
                    $release_find_ru = Release::find()
                        ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'ru-RU'])
                        ->one();
                    if ($release_find_ru){
                        //echo "Есть \n";
                        $d = Url::to(['/search/hash', 'q' => $release_find_ru->episode_article_key], true);
                        $this->stdout($d . "\n", Console::FG_RED);
                        if (!$release_find_ru->episode_plot){
                            echo "Делаем запрос к странице эпизода\n";
                            $episode_find = $this->getEpisode($release_name, $season, $episode_e);

                            // Описание эпизода
                            $plot = $episode_find['plot'];
                            if ($plot){
                                $release_find_ru->episode_plot = $plot;
                                $release_find_ru->update()? $this->stdout($plot."\n", Console::FG_RED) : 0;
                            }
                        }
                    }
                    else{
                        echo "Делаем запрос к странице эпизода\n";
                        $episode_find = $this->getEpisode($release_name, $season, $episode_e);
                        // Время эпизода
                        $runtime = $episode_find['runtime'];
                        // Описание эпизода
                        $plot = $episode_find['plot'];
                        // Дата выхода эпизода
                        $date_ru = $episode_find['date'];
                        //
                        $imagine_view_release_e = $episode_find['img'];
                        //
                        //$url_release = 'http://stream.free-ip.tv/uploads/'.$name_release.'.S0'.$season.'E'.$episode_e.'.720p.WEB.rus.LostFilm.TV.mp4';
                        $url_release = $this->getUrl($id, $season, $episode_e);
                        // добавляем в массив
                        if ($release_find_ru) {
                            if (!$release_find_ru->episode_plot){
//                                $release_find_ru->episode_plot = $plot;
//                                $release_find_ru->update()? $this->stdout($plot."\n", Console::FG_RED) : 0;
                            }
                            elseif (!$release_find_ru->episode_released){
                                $release_find_ru->episode_released = $date_ru;
                                $release_find_ru->update()? $this->stdout(date("Y-m-d", $date_ru)."\n", Console::FG_RED) : 0;
                            }
                        }
                        $this->stdout("Проход " . $i . "\n", Console::FG_GREY);
                        if ( !$release_find_ru ) {

                            if ( $name_ru != '' ) {
                                $this->stdout("Ищем в базе релиз\n", Console::FG_GREY);
                                $this->stdout("Начинаю запись в базу\n", Console::FG_GREY);
                                $update_at = time();
                                $episode_article_key = Yii::$app->security->generateRandomString();
                                $episode = new Release();
                                $episode->release_id = $id;
                                $episode->episode_article_key = $episode_article_key;
                                $episode->episode_url = $url_release;
                                $episode->episode_title = $name_ru;
                                $episode->episode_season = $season;
                                $episode->episode_season_number = $episode_e;
                                $episode->episode_plot = $plot;
                                $episode->episode_runtime = $runtime;
                                $episode->episode_language = 'ru-RU';
                                $episode->episode_released = $date_ru;
                                $episode->save() ? $save = 1 : $save = 0;
                                if ($save == 1) {
                                    $this->stdout("УСПЕХ\n", Console::FG_GREEN);
                                    $this->stdout("Русский релиз записан: Сериал " . $name ." (". $release_name . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $name_ru . "\n", Console::FG_RED);
                                    $this->getSend(
                                        "Вышел новый эпизод сериала " . $name ." ",
                                        "Сериал " . $name ." (". $release_name . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $name_ru,
                                        "" . $season,
                                        "" . $episode_e,
                                        "" . $name,
                                        "" . $name_ru,
                                        "" . $episode_article_key);
                                    $this->getNews(
                                        $name." (".$release_name .").".$name_ru.".(Сезон " .  $season . " Эпизод " . $episode_e . ")",
                                        "".$plot,
                                        "series",
                                        "/Images/".$id."/Posters/poster.jpg",
                                        "series" ,
                                        $date_ru,
                                        $update_at,
                                        $episode_article_key);
                                    $structure = '/home/guatra/sites/siteFree-ipTV/frontend/web/uploads/Images/'.$id.'/Posters/';
//                                    $structure = '/Users/guatra/Projects/siteParse/frontend/web/uploads/Images/'.$id.'/Posters/';
                                    if (file_exists($structure)) {
                                        $this->stdout("Папка существует\n", Console::FG_GREEN);
                                    } else {
                                        mkdir($structure, 0777, true);
                                    }

                                    $this->stdout("*** ".$release_name." \n", Console::FG_RED);
                                    // 715x330.JPEG(24-bit color) https://static.lostfilm.tv/Images/245/Posters/e_1_1.jpg
                                    $this->saveImage($structure, $status = 'episode', $imagine_view_release_e, $id, $season, $episode_e);
                                    $this->stdout("SAVE *** " . $imagine_view_release_e . " \n", Console::FG_RED);
                                }
                                if ($lostfilm->release_totalseasons !== (int)$season){
                                    if ($lostfilm->release_totalseasons < (int)$season){
                                        $find = FullName::findOne($id);
                                        $find->release_totalseasons = $season;
                                        $find->update() ? $save = 20  : $save = 10;
                                        if ( $save == 20 ){
                                            $this->stdout("Обновление количества сезонов на ".$season."\n", Console::FG_GREEN);
                                            $this->getSend(
                                                "Обновление количества сезонов сериала " . $name ." на " . $season,
                                                "Обновление количества сезонов сериала " . $name ." на " . $season,
                                                "" . $season,
                                                "" . $episode_e,
                                                "" . $name,
                                                "" . $name_ru,
                                                "" . $episode_article_key
                                            );
                                            //TODO Сбросить переменную и внести значение
                                            $lostfilm->release_totalseasons = $season;
                                        }
                                    }

                                }
                            }
                        }
                        $release_find = Release::find()
                            ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'en-US'])->one();
//                        if ( !$release_find ) {
//                            if ( $name_en != '' ) {
//                                $episode = new Release();
//                                $episode->release_id = $id;
//                                $episode->episode_article_key = Yii::$app->security->generateRandomString();
//                                $episode->episode_title = $name_en;
//                                $episode->episode_season = $season;
//                                $episode->episode_season_number = $episode_e;
//                                $episode->episode_plot = '';
//                                $episode->episode_runtime = $runtime;
//                                $episode->episode_language = 'en-US';
//                                $episode->save();
//                            }
//
//                        }
                    }

//                $data[$i] = ['save' => $save, 'serial' => $id, 'plot' => $plot, 'runtime' => $runtime, 'url' => $url, 'season' => $season, 'series' => $e[2], 'name_en' => $name_en, 'name_ru' => $name_ru, 'date_en' => $date_en[1]];
                }
                // увеличиваем счетчик
                $i++;
            }
        }

        echo "Закончили\n";
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $this->stdout("Ничего не делал $time секунд\n", Console::FG_RED);
    }

    /**
     * New series of LostFilm.tv
     * @param int $save
     * @param int $status
     * @param int $status_show
     */
    public function actionSeries($save = 0, $status = 1 , $status_show = 0)
    {
        $this->stdout("Обновляем ссылки с ", Console::FG_GREEN);
        $this->stdout("LostFilm.tv\n", Console::FG_RED);
        $this->stdout("*****************************\n", Console::FG_GREEN);
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', 'https://www.lostfilm.tv/series/');
//        $res = $client->request('GET', 'https://www.lostfilm.tv/series/?type=search&s=3&t=1');
        // устанавливаем счётчик
        $i = 0;
        // создаём пустой массив
        $data=[];
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        // выполняем проход циклом по списку
        $row = $document->find("div.row");
        // выполняем проход циклом по списку
        foreach ($row as $elem) {
            //pq аналог $ в jQuery
            $pq = pq($elem);
            // Имя русское
            $name_ru = $pq->find('a.no-decoration > div.body > div.name-ru')->text();
            // имя английское
            $name_en = $pq->find('a.no-decoration > div.body > div.name-en')->text();
            //
            $mark = $pq->find('div.mark-green-box')->text();
            $mark = (float)$mark;
            // считываем описание
            $url = $pq->find("a")->attr('href');

            $this->stdout("Разбиваем url на составляющие сериала ", Console::NORMAL);
            $this->stdout($name_ru."\n", Console::FG_RED);
            $alias = explode("/", $url);
            $alias = $alias[2];
            //
            $torrent = str_replace("_", ".", $alias);
            //
            $title_find = $pq->find("a.no-decoration > div.body > div.details-pane")->text();

            $title = explode(':', $title_find);
            $this->stdout("Обработка...\n", Console::NORMAL);
            $details_status = trim($title[1]);
            $details_year = trim($title[2]);
            $details_channel = explode('Жанр', $title[3]);
            $details_channel = $details_channel[0];
            $details_genre = trim($title[4]);

//            $status = strip_tags($details_status, '<br>');
            $statusr = explode(" ", $details_status);
            $status = $statusr[0];
            $status = explode("Год", $status);
            $status = trim($status[0]);
            if ($status == 'Премьера'){
                $status = 0;
            }
            elseif($status == 'Будет'){
                $status = 1;
                $status_show = 1;
            }
            elseif($status == 'Между'){
                $status = 1;
                $status_show = 1;
            }
            elseif($status == 'Идет'){
                $status = 1;
                $status_show = 1;
            }
            elseif($status == 'ЗавершенГод'){
                $status = 0;
                $status_show = 0;
            }
            elseif($status == 'Завершен'){
                $status = 0;
                $status_show = 0;
            }

            $details = $this->getSeries($alias);

            $year = (int)$details_year;
//            $channel = explode(" ", $details_channel);
            $channel = trim($details_channel);
            $plot = $details['series']['plot'];

            echo "Поиск в базе {$name_en}\n";
            $title_find = FullName::find()
                ->where(['release_lostfilm_alias'=> $alias])->one();
            if ($title_find AND $plot) {
                if (!$title_find->release_plot){
                    $title_find->release_plot = $plot;
                    $title_find->update()? $this->stdout($plot."\n", Console::FG_RED) : 0;
                }
            }
            if ($title_find) {echo "Запись в базе есть \n";}
            if (!$title_find) {

                $tv_show = new FullName();
                $tv_show->id = $details['series']['id'];
                $tv_show->release_name_ru = $name_ru;
                $tv_show->release_name_en = $name_en;
                $tv_show->release_totalseasons = 1;
                $tv_show->release_status = $status_show;
                $tv_show->release_show = $status;
                $tv_show->release_description = 'Смотреть в хорошем качестве';
                $tv_show->release_released = mktime(0,0,0,0,0,$year);
                $tv_show->release_channel = trim($details_channel);
                $tv_show->release_genre = $details_genre;
                $tv_show->release_plot = $details['series']['plot'];
                $tv_show->release_lostfilmrating = (string)$mark;
                $tv_show->release_lostfilmid = $details['series']['id'];
                $tv_show->release_lostfilm_alias = $alias;
                $tv_show->release_lostfilm_torrent = $torrent;
                $tv_show->release_trailer = $details['series']['trailer'];
                $tv_show->release_type = 'series';
                $tv_show->save() ? $save = 1 : $save = 10;
                if ($save == 1){
                    $this->stdout("Запись в базу   *******   ".$name_ru."\n", Console::FG_BLUE);
                }
                elseif ($save == 10) {
                    $this->stdout("Что-то пошло не так\n", Console::BG_RED);}
            }
            elseif ($title_find and $status == 1)
            {
                $title_find->release_show  = 1;
                $title_find->release_status = $status;
                $title_find->update() ? $save = 2 : $save = 3;
            }
            elseif (!$title_find->release_plot)
            {
                $title_find->release_plot  = $details['series']['plot'];
                $title_find->update() ? $save = 4 : $save = 3;
            }
            elseif ($title_find)
            {
                $title_find->release_trailer  = $details['series']['trailer'];
                $title_find->update() ? $save = 5 : $save = 3;
            }
            // добавляем в массив
            //$data[$i] = ['des' => $details_channel];
            $data[$i] = ['save' => $save, 'status_show' => $status_show, 'status'=> $status, 'details' => $details, 'year' => $year, 'channel' => $channel, 'genre' => $details_genre, 'lostfilm_id' => $details['series']['id'] ,'alias' => $alias, 'url' => $url, 'name_ru' => $name_ru, 'name_en' => $name_en, 'mark' => $mark];
            // увеличиваем счетчик
            $i++;

        }
        $this->stdout("Закончили\n", Console::FG_GREEN);

    }

    /**
     *
     */
    public function actionPicture($add){

        $time_start = microtime(true);
        $this->stdout("Скачиваем картинки с ", Console::FG_GREEN);
        $this->stdout("LostFilm.tv\n", Console::FG_RED);
        $this->stdout("*****************************\n", Console::FG_GREEN);
        $url_find = FullName::find()
            ->select(['release_lostfilmid', 'release_lostfilm_alias', 'release_totalseasons']) //Запрашиваем id в лостфильм картотеке
//            ->where(['release_show' => 0])
            ->where(['release_show' => 1, 'release_status' => 1, 'release_type' => 'series']) //где статус снимается и показывать значение true
            ->orderBy(['id' => SORT_DESC])
//            ->where(['release_lostfilmid' => $add])
            ->all(); // массив
        foreach ($url_find as $lostfilm) {
            // Работаем с получиным массивом
            $id = $lostfilm->release_lostfilmid;
            // Алиас имени
            $release_name = $lostfilm->release_lostfilm_alias;
            $release_total = $lostfilm->release_totalseasons;
            //
            $structure = 'C:/xampp/htdocs/free-ip.tv/frontend/web/uploads/Images/'.$id.'/Posters/';
//            $structure = '/Users/guatra/Projects/siteParse/frontend/web/uploads/Images/'.$id.'/Posters/';
            if (file_exists($structure)) {
                $this->stdout("Папка существует\n", Console::FG_GREEN);
            } else {
                mkdir($structure, 0777, true);
            }
            $this->stdout("*** ".$release_name." \n", Console::FG_RED);
            if (file_exists($structure.'poster.jpg')) {
                $this->stdout("Файл \"poster.jpg\" существует\n", Console::FG_GREEN);
            }else{
                $imagine_view_release_poster = 'https://static.lostfilm.tv/Images/'.$id.'/Posters/poster.jpg';
                // 715x330.JPEG(24-bit color)
                $this->saveImage($structure, $status = 'poster', $imagine_view_release_poster, $id);
                $this->stdout("SAVE *** ".$imagine_view_release_poster." \n", Console::FG_RED);
            }

            if (file_exists($structure.'image.jpg')) {
                $this->stdout("Файл \"image.jpg\" существует\n", Console::FG_GREEN);
            }else{
                $imagine_view_release_image = 'https://static.lostfilm.tv/Images/'.$id.'/Posters/image.jpg';
                // 240x144.JPEG(24-bit color)
                $this->saveImage($structure, $status = 'image', $imagine_view_release_image, $id);
                $this->stdout("SAVE *** ".$imagine_view_release_image." \n", Console::FG_RED);
            }
            if (file_exists($structure.'icon.jpg')){
                $this->stdout("Файл \"icon.jpg\" существует\n", Console::FG_GREEN);
            }else{
                $imagine_view_release_icon = 'https://static.lostfilm.tv/Images/'.$id.'/Posters/icon.jpg';
                // 40x40.JPEG(24-bit color) https://static.lostfilm.tv/Images/245/Posters/icon.jpg
                $this->saveImage($structure, $status = 'icon', $imagine_view_release_icon, $id);
                $this->stdout("SAVE *** ".$imagine_view_release_icon." \n", Console::FG_RED);

            }
            $this->stdout("Всего сезонов *** ".$release_total." \n", Console::FG_GREEN);
            for ($i = 1; $i <= $lostfilm->release_totalseasons; $i++)
            {
                // Находим все серии сезона
                $find_season = Release::find()
                    ->where(['release_id' => $id,'episode_season' => $i, 'episode_language' => 'ru-RU'])
                    ->all();
                $this->stdout("Получаем количество серии \n", Console::FG_GREEN);
                $n = count($find_season);
                $this->stdout("Количество серий в сезоне: ".$n." \n", Console::FG_GREEN);

                if (file_exists($structure.'t_shmoster_s'.$i.'.jpg')){
                    $this->stdout("Файл \"t_shmoster_s\" существует\n", Console::FG_GREEN);
                }else{
                    // 120x160.JPEG(24-bit color)
                    $imagine_view_release_t_shmoster_s = 'https://static.lostfilm.tv/Images/'.$id.'/Posters/t_shmoster_s'.$i.'.jpg';
                    $this->saveImage($structure, $status = 't_shmoster_s', $imagine_view_release_t_shmoster_s, $id, $i);
                    $this->stdout("SAVE *** ".$imagine_view_release_t_shmoster_s." \n", Console::FG_RED);
                }

                if (file_exists($structure.'shmoster_s'.$i.'.jpg')){
                    $this->stdout("Файл \"shmoster_s\" существует\n", Console::FG_GREEN);
                }else{
                    // 375x500.JPEG(24-bit color)
                    $imagine_view_release_shmoster_s = 'https://static.lostfilm.tv/Images/'.$id.'/Posters/shmoster_s'.$i.'.jpg';
                    $this->saveImage($structure, $status = 'shmoster_s', $imagine_view_release_shmoster_s, $id, $i);
                    $this->stdout("SAVE *** ".$imagine_view_release_shmoster_s." \n", Console::FG_RED);
                }

//                for ($m = 1; $m <= $n; $m++)
//                {
//                    if (file_exists($structure.'e_'.$i.'_'.$m.'.jpg')){
//                        $this->stdout("Файл \"e_".$i."_".$m.".jpg\" существует\n", Console::FG_GREEN);
//                    }else {
//                        // 715x330.JPEG(24-bit color) https://static.lostfilm.tv/Images/245/Posters/e_1_1.jpg
//                        $imagine_view_release_e = 'https://static.lostfilm.tv/Images/' . $id . '/Posters/e_' . $i . '_' . $m . '.jpg';
////                            $this->saveImage($structure, $status = 'episode', $imagine_view_release_e, $id, $i, $m);
////                            $this->stdout("SAVE *** " . $imagine_view_release_e . " \n", Console::FG_RED);
//
//                        if ( file_exists($imagine_view_release_e) ) {
//                            $this->stdout("Файл $imagine_view_release_e не существует\n", Console::FG_RED);
//                            $imagine_view_release_e = 'https://static.lostfilm.tv/Images/110/Posters/e_8_17.jpg';
//                        } else {
//                            $this->stdout("Файл $imagine_view_release_e существует\n", Console::FG_RED);
//                            $this->saveImage($structure, $status = 'episode', $imagine_view_release_e, $id, $i, $m);
//                            $this->stdout("SAVE *** " . $imagine_view_release_e . " \n", Console::FG_RED);
//                        }
////                                if (file_exists($imagine_view_release_e)){
////                                    $this->stdout("Файл \"e_".$i."_".$m.".jpg\" не существует\n", Console::FG_RED);
////                            }
//                    }
//                }
            }

        }

        //https://static.lostfilm.tv/Images/245/Posters/poster.jpg//
        //https://static.lostfilm.tv/Images/215/Posters/image.jpg//
        //https://static.lostfilm.tv/Images/245/Posters/t_shmoster_s1.jpg//
        //https://static.lostfilm.tv/Images/245/Posters/shmoster_s1.jpg//
        //https://static.lostfilm.tv/Images/245/Posters/e_1_1.jpg
        //https://static.lostfilm.tv/Images/245/Posters/icon.jpg

        //$data[$release_name] = ['id' => $id, 'season' => $lostfilm->release_totalseasons, 'savePoster' => $savePoster, 'saveImage' => $saveImage];

        $this->stdout("Закончили\n", Console::FG_GREEN);
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $this->stdout("Ничего не делал $time секунд\n", Console::FG_RED);

    }

    public function actionCicle($url = null){
        $time_start = microtime(true);

        for ($n = 1; $n <= 500; $n++) {


            $this->stdout("**************************\n", Console::FG_GREEN);
            $this->stdout("Page {$n}\n", Console::FG_GREEN);
            $this->stdout("**************************\n", Console::FG_GREEN);
            $url = "https://www.lostfilm.tv/new/page_".$n;//$url = "https://www.lostfilm.tv/new/";
            // создаем экземпляр класса
            $client = new Client();
            // отправляем запрос к странице
            //https://www.lostfilm.tv/series/?type=search&s=3&t=1
            $res = $client->request('GET', $url);
            // устанавливаем счётчик
            $i = 0;
            // создаём пустой массив
            $data = [];
            // получаем данные между открывающим и закрывающим тегами body
            $body = $res->getBody();
            // подключаем phpQuery
            $document = \phpQuery::newDocumentHTML($body);
            // выполняем проход циклом по списку
            $row = $document->find("div.row");
            // выполняем проход циклом по списку
            foreach ($row as $elem) {
                //pq аналог $ в jQuery
                $pq = pq($elem);
                // id сериала
                $data_release_name = $pq->find('a:first')->attr('href');
                $release_name = explode("/", $data_release_name);
                $release_name = $release_name[2];
                //
                $lostfilm = FullName::find()
                    ->select(['release_lostfilmid', 'release_lostfilm_alias', 'release_totalseasons'])//Запрашиваем id в лостфильм картотеке
//            ->where(['release_show' => 0])
//            ->where(['release_show' => 1, 'release_status' => 1]) //где статус снимается и показывать значение true
                    ->where(['release_lostfilm_alias' => $release_name])
                    // ->asArray()
                    ->one(); // массив
                // TODO если нет то нужно внести в базу ( навсякий случай )
                $id = $lostfilm['release_lostfilmid'];
                // Имя русское сериала
                $name_ru = $pq->find('a > div.body > div.name-ru')->text();
                // имя английское
                $name_en = $pq->find('a > div.body > div.name-en')->text();
                //
                $title = $pq->find('.details-pane > .alpha:first')->text();
                //
                $season_series = $pq->find('.left-part')->text();
                if ($season_series == "Спецэпизод 1") {
                    $season = 1;
                    $episode_e = 1;
                }
                elseif ($season_series == "Спецэпизод 2") {
                    $season = 1;
                    $episode_e = 1;
                }
                elseif ($season_series == "Спецэпизод 3") {
                    $season = 1;
                    $episode_e = 1;
                }
                elseif ($season_series == "Спецэпизод 4") {
                    $season = 1;
                    $episode_e = 1;
                }
                else{
                    $e = explode(" ", $season_series);
                    $season = $e[0];
                    $episode_e = $e[2];
                }
                // Делаем запрос к базе, на наличие
                $release_find_ru = Release::find()
                    ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'ru-RU'])
                    ->asArray()
                    ->one();
                // Если эпизода нет, то делаем запрос к станице эпизода
                if ( !$release_find_ru ) {
                    echo "Делаем запрос к странице эпизода\n";
                    $episode_find = $this->getEpisode($release_name, $season, $episode_e);
//                $release_find_ru = $episode_find;
                    // Время эпизода
                    $runtime = $episode_find['runtime'];
                    // Описание эпизода
                    $plot = $episode_find['plot'];
                    // Дата выхода эпизода
                    $date_ru = $episode_find['date'];
                    //
                    $imagine_view_release_e = $episode_find['img'];
                    //
                    $url_release = $this->getUrl($id, $season, $episode_e);
                    //
//                $this->stdout("Ищем в базе релиз\n", Console::FG_GREY);
//                $this->stdout("Начинаю запись в базу\n", Console::FG_GREY);
                    $update_at = time();
                    //

                    $episode_article_key = Yii::$app->security->generateRandomString();
                    //
                    $this->stdout("Ищем в базе релиз\n", Console::FG_GREY);
                    $this->stdout("Начинаю запись в базу\n", Console::FG_GREY);
                    $episode = new Release();
                    $episode->release_id = $id;
                    $episode->episode_article_key = $episode_article_key;
                    $episode->episode_url = $url_release;
                    $episode->episode_title = $title;
                    $episode->episode_season = $season;
                    $episode->episode_season_number = $episode_e;
                    $episode->episode_plot = $plot;
                    $episode->episode_runtime = $runtime;
                    $episode->episode_language = 'ru-RU';
                    $episode->episode_released = $date_ru;
                    $episode->save() ? $save = 1 : $save = 0;
                    if ( $save == 1 ) {
                        $this->stdout("УСПЕХ\n", Console::FG_GREEN);
                        $this->stdout("Русский релиз записан: Сериал " . $name_ru . " (" . $name_en . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $title . "\n", Console::FG_RED);
                        $this->getSend(
                            "Вышел новый эпизод сериала " . $name_ru . " ",
                            "Сериал " . $name_ru . " (" . $name_en . ") Сезон " . $season . " Эпизод " . $episode_e . " Название: " . $title,
                            "" . $season,
                            "" . $episode_e,
                            "" . $title,
                            "" . $name_ru,
                            "" . $episode_article_key);
                        $this->getNews(
                            $name_ru . " (" . $name_en . "). " . $title . ". (Сезон " . $season . " Эпизод " . $episode_e . ")",
                            "" . $plot,
                            "series",
                            "/Images/" . $id . "/Posters/poster.jpg",
                            "series",
                            $date_ru,
                            $update_at,
                            $episode_article_key);
                        $structure = '/home/guatra/sites/siteFree-ipTV/frontend/web/uploads/Images/'.$id.'/Posters/';
//                        $structure = '/Users/guatra/Projects/siteParse/frontend/web/uploads/Images/' . $id . '/Posters/';
                        if ( file_exists($structure) ) {
                            $this->stdout("Папка существует\n", Console::FG_GREEN);
                        } else {
                            mkdir($structure, 0777, true);
                        }

                        $this->stdout("*** " . $release_name . " \n", Console::FG_RED);
                        // 715x330.JPEG(24-bit color) https://static.lostfilm.tv/Images/245/Posters/e_1_1.jpg
                        $this->saveImage($structure, $status = 'episode', $imagine_view_release_e, $id, $season, $episode_e);
                        $this->stdout("SAVE *** " . $imagine_view_release_e . " \n", Console::FG_RED);
                    }

                } else {
                    // Если эпизод есть, проверяем наличие пыстых значений
                    if ( !$release_find_ru['episode_plot'] ) {

                        $this->stdout("Сериал {$name_ru}, эпизод есть , проверяем наличие обновления описания\n", Console::FG_GREY);
                        $episode_find = $this->getEpisode($release_name, $season, $episode_e);
                        // Описание эпизода
                        $plot = $episode_find['plot'];
                        if ( $plot ) {
                            $update_plot = Release::findOne($release_find_ru['id']);
                            $update_plot->episode_plot = $plot;
                            $update_plot->update() ? $this->stdout("Запись описания:\n" . $plot . "\n", Console::FG_RED) : 0;
                        } else {
                            $this->stdout("нечего нового\n", Console::FG_RED);
                        }
                    }
                }
                // добавляем в массив
                //$data[$i] = ['des' => $details_channel];
                //$data[$i] = ['name_ru' => $name_ru, 'name_en' => $name_en, 'div'=> $title ];
                // увеличиваем счетчик
                //$i++;

            }
        }
        echo "Закончили\n";
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $this->stdout("Ничего не делал $time секунд\n", Console::FG_RED);
    }

    public function actionSend(){
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['noReplyEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Отчёт по новым сериям')
            ->setTextBody('')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();

    }
    /**
     * Метод для записи картинок
     * @param null $poster_view_release_image
     * @param int $id
     * @param null $season
     * @param null $episode
     * @param null $folder
     * @return \Imagine\Image\ImageInterface
     */
    protected function saveImage($structure, $status = 'poster', $poster_view_release_image = null, $id = 1 , $season = null, $episode = null, $folder = null)
    {

        $image = Image::getImagine();
        $newImage = $image->open($poster_view_release_image);
//        $structure = '/Users/guatra/Projects/siteParse/backend/web/uploads/Images/'.$id.'/Posters/';

//            $newImage->effects()->blur(3);
        if ($status == 'poster'){
            $newImage->save(Yii::getAlias($structure.'poster.jpg'), ['quality' => 100]);
        }elseif ($status == 'image'){
            $newImage->save(Yii::getAlias($structure.'image.jpg'), ['quality' => 100]);
        }elseif ($status == 'icon'){
            $newImage->save(Yii::getAlias($structure.'icon.jpg'), ['quality' => 100]);
        }elseif ($status == 't_shmoster_s'){
            $newImage->save(Yii::getAlias($structure.'t_shmoster_s'.$season.'.jpg'), ['quality' => 100]);
        }elseif ($status == 'shmoster_s'){
            $newImage->save(Yii::getAlias($structure.'shmoster_s'.$season.'.jpg'), ['quality' => 100]);
        }elseif ($status == 'episode'){
            $newImage->save(Yii::getAlias($structure.'e_'.$season.'_'.$episode.'.jpg'), ['quality' => 100]);
        }


        // $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
//        $newImage->save(Yii::getAlias('@runtime/poster_view_release_image.jpg'), ['quality' => 100]);
        return $newImage;
    }

    protected function getUrl($id = '1', $season = 1, $episode = 1)
    {
        //http://tracktor.in/td.php?s=iSsyrnX%2F5KxRv0P2FgRPVRpOCXGx8jdxLzEu27L7sna8Igy1X9z%2Be7K2%2Fp4mR%2FuGYBhm29PhvVGgWf6A%2B5eDgHspPCF10q5TRdiUSjDnQTVMJ8t082iOOrn2SqhzaZxrBWjfrw%3D%3D
        //Narcos.S03E01.720p.WEB.rus.LostFilm.TV.mp4

        $find = FullName::findOne($id);
        if ($find->release_lostfilm_torrent) {

            $stream = Yii::getAlias('@stream');

            $lostfilm_torrent = $find->release_lostfilm_torrent;

            if ($season == 1){
                $season = '01';
            }elseif ($season == 2){
                $season = '02';
            }elseif ($season == 3){
                $season = '03';
            }elseif ($season == 4){
                $season = '04';
            }elseif ($season == 5){
                $season = '05';
            }elseif ($season == 6){
                $season = '06';
            }elseif ($season == 7){
                $season = '07';
            }elseif ($season == 8){
                $season = '08';
            }elseif ($season == 9){
                $season = '09';
            }
            if ($episode == 1){
                $episode = '01';
            }elseif ($episode == 2){
                $episode = '02';
            }elseif ($episode == 3){
                $episode = '03';
            }elseif ($episode == 4){
                $episode = '04';
            }elseif ($episode == 5){
                $episode = '05';
            }elseif ($episode == 6){
                $episode = '06';
            }elseif ($episode == 7){
                $episode = '07';
            }elseif ($episode == 8){
                $episode = '08';
            }elseif ($episode == 9){
                $episode = '09';
            }

            $url = $stream.'/'.$lostfilm_torrent.'.S'.$season.'E'.$episode.'.720p.WEB.rus.LostFilm.TV.mp4';
        }
        else{
            $url = null;
        }

        return $url;
    }

    protected function setNewSeries(){

    }
    protected function getSerial($alias = 'American_Gods')
    {
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', 'https://www.lostfilm.tv/series/'.$alias.'/');
        // устанавливаем счётчик
        $i = 0;
        // создаём пустой массив
        $data=[];
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //
        $data = $document->find("div.title-block > .image-block > .main_poster")->attr('style');
        $data = explode('/', $data);
        $serial = $data[4];
        return $serial;
    }

    protected function getEpisode($release_name = 'Fargo', $season_series = 3, $episode = 2)
    {
        $url_plot_episode = 'https://www.lostfilm.tv/series/'.$release_name.'/season_'.$season_series.'/episode_'.$episode.'/';

        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', $url_plot_episode);
        // устанавливаем счётчик
        $i = 0;
        // создаём пустой массив
        $data_e=[];
        $data1=[];
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        // выполняем проход циклом по списку

        $movie_parts_list = $document->find("tr");

        //$row = explode("Сюжет", $row);
        $plot =  $document->find("div.text-block.description > .body > .body")->text();
        //
        $data_date = $document->find(".title-block > .details-pane > .left-box")->text();
        $data_date = explode(" ", trim($data_date));
        if (!$data_date[3]){ $date = null;}
        else {
            $year = $data_date[5];
            $day = $data_date[3];
            $month = $data_date[4];
            if ($month == 'января') { $month = 1;}
            elseif ($month == 'февраля') { $month = 2;}
            elseif ($month == 'марта') { $month = 3;}
            elseif ($month == 'апреля') { $month = 4;}
            elseif ($month == 'мая') { $month = 5;}
            elseif ($month == 'июня') { $month = 6;}
            elseif ($month == 'июля') { $month = 7;}
            elseif ($month == 'августа') { $month = 8;}
            elseif ($month == 'сентября') { $month = 9;}
            elseif ($month == 'октября') { $month = 10;}
            elseif ($month == 'ноября') { $month = 11;}
            elseif ($month == 'декабря') { $month = 12;}
            $date = mktime(0, 0, 0, $month, $day, $year);
        }

        //
        $data = $document->find(".title-block > .details-pane > div")->text();
        $data = explode("Длительность:", trim($data));
        $runtime = explode("мин", trim($data[1]));
        $runtime = (int)$runtime[0];
        $data_img = $document->find(".main_poster > img")->attr("src");
        $img = "http:" . $data_img;
        $data_e = ['plot' => $plot,'runtime' => $runtime, 'date' => $date, 'img' => $img];
        //return $this->render('episode', ['data' => $plot]);
        return $data_e;
    }

    protected function getSeries($alias = 'American_Gods')
    {
        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице
        $res = $client->request('GET', 'https://www.lostfilm.tv/series/'.$alias.'/');
        // устанавливаем счётчик
        $i = "series";
        // создаём пустой массив
        $data=[];
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //
        $poster = $document->find("div.title-block > .image-block > .main_poster")->attr('style');
        $lostfilm_id = explode('/', $poster);
        $series = $lostfilm_id[4];
        $poster = substr($poster, 0, -3);
        $poster = substr($poster, 18, strlen($poster));
        $poster_view_release_image = "http://".$poster;
        $plot = $document->find("div.body > div.body")->texts();
        $plot = explode('Сюжет', $plot[0]);
        $count_plot_array = count($plot);

        if ($count_plot_array == 1){
            $plot = trim($plot[0]);
        }
        elseif($count_plot_array !== 1){
            $plot = trim($plot[1]);
        }
        $trailer = $document->find(".play-btn")->attr('data-src');

        $data[$i] = ['id' => $series, 'count' => $count_plot_array, 'plot' => $plot, 'trailer' => $trailer, 'poster_view_release_image' => $poster_view_release_image];

        return $data;
    }

    /**
     * This is method
     * @param string $title
     * @param null $content
     * @param string $author
     * @param null $image
     * @param null $type
     * @param null $create_at
     * @param null $update_at
     * @param null $episode_article_key
     */
    protected function getNews($title = 'news', $content = null, $author = 'content', $image = null, $type = null, $create_at = null, $update_at = null, $episode_article_key = null ){
        $news = new News();
        $news->title = $title;
        $news->content = $content;
        $news->author = $author;
        $news->image = $image;
        $news->type = $type;
        $news->created_at = $create_at;
        $news->updated_at = $update_at;
        $news->episode_article_key = $episode_article_key;
        $news->save();
    }

    protected function getSend($subject, $message, $season, $episode, $title, $name, $episode_article_key) {
        Yii::$app->mailer->compose( "lostfilm_episode", ['content' => $message, 'season' => $season, 'episode' => $episode, 'title' => $title, 'name' => $name, 'episode_article_key' => $episode_article_key])
            ->setFrom([Yii::$app->params['noReplyEmail'] => 'Free-IP.tv'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            //->setTextBody('')
            //->setHtmlBody($subject)
            ->send();
    }

    public function actionEmail($subject = 'new torrent', $message = 'http://tracktor.in/td.php?s=EiWNxIVIXShxqMiSfzato2uSsiUSITM3O5C8q6r7m5YoEbl%2BqcGN2juz10cH4kky02ITD1U%2FkyAqV5HOUd3BR0jcar3ZHHO5DkdG0uoA9AHA%2BSCG%2BdbQAhRx57jgTLP1XMMmuw%3D%3D') {
        Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['noReplyEmail'] => 'Free-IP.tv'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            //->setTextBody('')
            ->setHtmlBody($message)
            ->send();
    }
}