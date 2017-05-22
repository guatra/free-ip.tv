<?php
namespace console\controllers;

use Yii;
use GuzzleHttp\Client; // подключаем Guzzle
use backend\models\FullName;
use backend\models\Release;

class LostfilmController extends \yii\console\Controller
{
    public function actionUpdate()
    {

        $url_find = FullName::find()
            ->select(['release_lostfilmid', 'release_lostfilm_alias']) //Запрашиваем lostfilm_id в картотеке
//            ->where(['release_show' => 208])
            ->where(['release_show' => 1, 'release_status' => 1]) //где статус снимается и показывать значение true
//         lost//
//            ->where(['release_lostfilmid' => 208])
            ->all(); // массив
        echo "Находим массив по сериалам\n";
        echo "*****************************\n";
        foreach ($url_find as $lostfilm) {
            echo "Начинаю перебирать массив\n";
            //
            echo "Работаем с получиным массивом\n";
            $id = $lostfilm->release_lostfilmid;
            // Алиас имени
            echo "Алиас имени\n";
            $release_name = $lostfilm->release_lostfilm_alias;
            //
            $url = 'https://www.lostfilm.tv/series/' . $release_name . '/seasons/';
            //
            echo "Набираю обороты\n";
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
            echo "выполняем проход циклом по списку серий\n";
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

                if ($season_series) {
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
                $date_ru = null;
                $date_en = explode(" ", $n);

                // Если эпизода нет, то делаем запрос к странице эпизода
                $episode_find = $this->getEpisode($release_name, $season, $episode_e);
                // Время эпизода
                $runtime = $episode_find['runtime'];
                // Описание эпизода
                $plot = $episode_find['plot'];

                // добавляем в массив

                $release_find_ru = Release::find()
                    ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'ru-RU'])->one();
                echo "Проход ".$i."\n";
                if ( !$release_find_ru ) {
                    echo "Ищем в базе релиз\n";
                    if ( $name_ru != '' ) {
                        echo "Начинаю запись в базу\n";
                        $episode = new Release();
                        $episode->release_id = $id;
                        $episode->episode_article_key = Yii::$app->security->generateRandomString();
                        $episode->episode_title = $name_ru;
                        $episode->episode_season = $season;
                        $episode->episode_season_number = $episode_e;
                        $episode->episode_plot = $plot;
                        $episode->episode_runtime = $runtime;
                        $episode->episode_language = 'ru-RU';
                        $episode->episode_released = $date_ru;
                        $episode->save();
                       // $episode->save() ? $this->getSend() : 1;
                        echo "Русский релиз записан: Сериал ".$release_name." Сезон ".$season." Эпизод ".$episode_e." Название ".$name_ru."\n";
                    }
                }
                $release_find = Release::find()
                    ->where(['release_id' => $id, 'episode_season' => $season, 'episode_season_number' => $episode_e, 'episode_language' => 'en-US'])->one();
                if ( !$release_find ) {
                    if ( $name_en != '' ) {
                        $episode = new Release();
                        $episode->release_id = $id;
                        $episode->episode_article_key = Yii::$app->security->generateRandomString();
                        $episode->episode_title = $name_en;
                        $episode->episode_season = $season;
                        $episode->episode_season_number = $episode_e;
                        $episode->episode_plot = '';
                        $episode->episode_runtime = $runtime;
                        $episode->episode_language = 'en-US';
//                    $episode->episode_released = $date_en;
                        $episode->save();
                    }

                }
//                $data[$i] = ['save' => $save, 'serial' => $id, 'plot' => $plot, 'runtime' => $runtime, 'url' => $url, 'season' => $season, 'series' => $e[2], 'name_en' => $name_en, 'name_ru' => $name_ru, 'date_en' => $date_en[1]];

                // увеличиваем счетчик
                $i++;

            }

        }

        echo "Закончили\n";
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
        $data = $document->find(".title-block > .details-pane > div")->text();
        $data = explode("Длительность:", trim($data));
        $runtime = explode("мин", trim($data[1]));
        $runtime = (int)$runtime[0];
        $data_e = ['plot' => $plot,'runtime' => $runtime];
        //return $this->render('episode', ['data' => $plot]);
        return $data_e;
    }

    protected function getSend() {
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['noReplyEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Отчёт по новым сериям')
            ->setTextBody('')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}