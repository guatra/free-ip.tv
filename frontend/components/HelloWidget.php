<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class HelloWidget extends Widget
{
    public $message;
    public $time;

    public function init()
    {
        $this->time = date('G', time());
        parent::init();
        if ($this->message === null) {
            if ($this->time >= 0 and $this->time <= 6) {
                $this->message = Yii::t('frontend', 'APP_GOOD_NIGHT').$this->time;
            }
            elseif ($this->time >= 6 and $this->time <= 12) {
                $this->message = Yii::t('frontend', 'APP_GOOD_MORNING').$this->time;
            }
            elseif ($this->time >= 12 and $this->time <= 18) {
                $this->message = Yii::t('frontend', 'APP_GOOD_DAY').$this->time;
            }
            elseif ($this->time >= 18 and $this->time <= 23) {
                $this->message = Yii::t('frontend', 'APP_GOOD_EVENING').$this->time;
            }

        }
    }

    public function run()
    {
        return Html::encode($this->message);
    }
}