<?php 

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class UserPACMEC extends ActiveRecord 
{
    public function getAvatarUrl() {
        if (!empty($this->email)) {
            $hash = hash('sha256', strtolower(trim($this->email)));
            return "https://gravatar.com/avatar/{$hash}.jpg";
        }
        return 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp';
    }
}