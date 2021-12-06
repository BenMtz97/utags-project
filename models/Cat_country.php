<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Query;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_country';
    }

    public function getCountries(){
        $rows = (new Query())
            ->select('*')
            ->from(self::tableName());
        return $rows->all();
    }

    public function getCountry($id){
        $rows = (new Query())
            ->select('*')
            ->from(self::tableName());

        if(is_int($id)){
            $field = 'idcat_country';
        }
        elseif(is_string($id)){
            $field = 'key';
        }
        $rows = $rows->where([$field => $id]);

        return $rows->one();

        $country = static::findOne(['idcat_country']);
        if($country != null)
            return $country->toArray();
        return null;
    }

}