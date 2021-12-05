<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string $idcat_country
 * @property string $key
 * @property string $name
 *
 */
class Cat_country extends ActiveRecord
{
    public function getCountries(){
        $countries = static::find();
    }

}