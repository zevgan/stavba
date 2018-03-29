<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "detail_platby".
 *
 * @property int $id
 * @property string $nazev_platby Detail platby
 *
 * @property Faktury[] $fakturies
 */
class DetailPlatby extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_platby';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nazev_platby'], 'required'],
            [['nazev_platby'], 'string', 'max' => 200],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nazev_platby' => Yii::t('app', 'Detail platby'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakturies()
    {
        return $this->hasMany(Faktury::className(), ['detail_platby' => 'id']);
    }

    public function getDetailPlatbyList()
    {
        $parents = DetailPlatby::find()
            ->select(['detail_platby.id', 'detail_platby.nazev_platby'])
            ->all();

        return ArrayHelper::map($parents, 'id', 'nazev_platby');
    }

    public function getDetailPlatbyById($id)
    {
        $parents = DetailPlatby::find()
            ->where(['id' => $id])->one();

        return ArrayHelper::map($parents, 'id', 'nazev_platby');
    }

    /**
     * @inheritdoc
     * @return DetailPlatbyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetailPlatbyQuery(get_called_class());
    }
}
