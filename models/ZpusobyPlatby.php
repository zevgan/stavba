<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "zpusoby_platby".
 *
 * @property int $id
 * @property string $nazev_zpusob Způsob platby
 *
 * @property Faktury[] $fakturies
 */
class ZpusobyPlatby extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zpusoby_platby';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazev_zpusob'], 'required'],
            [['nazev_zpusob'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nazev_zpusob' => Yii::t('app', 'Způsob platby'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakturies()
    {
        return $this->hasMany(Faktury::className(), ['zpusob_platby' => 'id']);
    }



    public function getZpusobyPlatbyList()
    {
        $parents = ZpusobyPlatby::find()
            ->select(['zpusoby_platby.id', 'zpusoby_platby.nazev_zpusob'])
            ->all();

        return ArrayHelper::map($parents, 'id', 'nazev_zpusob');
    }
    /**
     * @inheritdoc
     * @return ZpusobyPlatbyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ZpusobyPlatbyQuery(get_called_class());
    }
}
