<?php
namespace frontend\models;

use yii\base\Model;
use frontend\models\FullName;

/**
 * Search form
 */
class SearchForm extends Model
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['q', 'trim'],
//            ['q', 'required'],
//            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['q', 'string', 'min' => 2, 'max' => 255],

        ];
    }

//    /**
//     * Signs user up.
//     *
//     * @return User|null the saved model or null if saving fails
//     */
//    public function signup()
//    {
//        if (!$this->validate()) {
//            return null;
//        }
//
//        $user = new User();
//        $user->username = $this->username;
//        $user->email = $this->email;
//        $user->setPassword($this->password);
//        $user->generateAuthKey();
//
//        return $user->save() ? $user : null;
//    }
}
