<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "platce".
 *
 * @property int $id
 * @property string $nazev_platce Jméno plátce
 *
 * @property Faktury[] $fakturies
 */
class Platce extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'platce';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazev_platce'], 'required'],
            [['nazev_platce'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nazev_platce' => Yii::t('app', 'Jméno plátce'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakturies()
    {
        return $this->hasMany(Faktury::className(), ['platce' => 'id']);
    }

    public function getPlatceList()
    {
        $parents = Platce::find()
            ->select(['platce.id', 'platce.nazev_platce'])
            ->all();

        return ArrayHelper::map($parents, 'id', 'nazev_platce');
    }


    /**
     * @inheritdoc
     * @return PlatceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlatceQuery(get_called_class());
    }
}
