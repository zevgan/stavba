<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "firmy".
 *
 * @property int $id
 * @property string $nazev_firmy Název právnické osoby
 *
 * @property Faktury[] $fakturies
 */
class Firmy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'firmy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazev_firmy'], 'required'],
            [['nazev_firmy'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nazev_firmy' => Yii::t('app', 'Název právnické osoby'),
        ];
    }

    public function getFirmyList()
    {

        $parents = Firmy::find()
            ->select(['firmy.id', 'firmy.nazev_firmy'])
            ->all();

        return ArrayHelper::map($parents, 'id', 'nazev_firmy');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakturies()
    {
        return $this->hasMany(Faktury::className(), ['spolecnost' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FirmyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FirmyQuery(get_called_class());
    }
}
