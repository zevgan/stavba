<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "faktury".
 *
 * @property int $id
 * @property int $spolecnost
 * @property string $datum_zp
 * @property string $datum_platby
 * @property int $zpusob_platby
 * @property int $platce

 * @property string $bez_dph
 * @property string $dph
 * @property string $vc_dph
 * @property string $poznamka

 *

 * @property Firmy $spolecnost0
 * @property ZpusobyPlatby $zpusobPlatby
 * @property Platce $platce0

 */
class Faktury extends \yii\db\ActiveRecord
{

    /**
     * @var array
     */
    public $detaily = [];
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faktury';
    }





    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spolecnost', 'datum_zp', 'datum_platby', 'zpusob_platby', 'platce', 'bez_dph', 'dph'], 'required'],
            [['spolecnost', 'zpusob_platby', 'platce'], 'integer'],
            [['datum_zp', 'datum_platby', 'zpusob_platby', 'detaily', 'detaily_ids', 'spolecnost'], 'safe'],
            [['bez_dph', 'dph', 'vc_dph'], 'double'],
            [['poznamka'], 'string', 'max' => 500],
            [['detaily_ids'], 'each', 'rule' => ['integer']],
            [['detaily'], 'each', 'rule' => ['string']],
            

            [['spolecnost'], 'exist', 'skipOnError' => true, 'targetClass' => Firmy::className(), 'targetAttribute' => ['spolecnost' => 'id']],
          [['zpusob_platby'], 'exist', 'skipOnError' => true, 'targetClass' => ZpusobyPlatby::className(), 'targetAttribute' => ['zpusob_platby' => 'id']],
            [['platce'], 'exist', 'skipOnError' => true, 'targetClass' => Platce::className(), 'targetAttribute' => ['platce' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'detaily_ids' => 'detaily',
                ],
            ],
        ];
    }

    public function getDetaily()
    {
        return $this->hasMany(DetailPlatby::className(), ['id' => 'detail'])
            ->viaTable('{{%faktura_detail}}', ['faktura' => 'id']);
    }

    public function getDetailyNames()
    {
        $result='';

        $parent = $this->detaily_ids;

       foreach ($parent as $p) $result.=DetailPlatby::findOne($p)->nazev_platby.", ";
        $result=rtrim($result, ', ');

        return $result;
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'spolecnost' => Yii::t('app', 'Společnost'),
            'datum_zp' => Yii::t('app', 'Datum ZP'),
            'datum_platby' => Yii::t('app', 'Datum Platby'),
            'zpusob_platby' => Yii::t('app', 'Způsob Platby'),
            'platce' => Yii::t('app', 'Plátce'),
            
            'detaily' => Yii::t('app', 'Detaily Platby'),
            'bez_dph' => Yii::t('app', 'Bez Dph'),
            'dph' => Yii::t('app', 'Dph'),
            'vc_dph' => Yii::t('app', 'Vč Dph'),
            'poznamka' => Yii::t('app', 'Poznámka'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpolecnost0()
    {
        return $this->hasOne(Firmy::className(), ['id' => 'spolecnost']);
    }

    public function getSpolecnostName()
    {
        $parent = $this->spolecnost0;

        return $parent ? $parent->nazev_firmy : '';
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZpusobPlatby()
    {
        return $this->hasOne(ZpusobyPlatby::className(), ['id' => 'zpusob_platby']);
    }




    public function getZpusobPlatbyName()
    {
        $parent = $this->zpusobPlatby;

        return $parent ? $parent->nazev_zpusob : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatce0()
    {
        return $this->hasOne(Platce::className(), ['id' => 'platce']);
    }

    public function getPlatceName()
    {
        $parent = $this->platce0;

        return $parent ? $parent->nazev_platce : '';
    }





    /**
     * @inheritdoc
     * @return FakturyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FakturyQuery(get_called_class());
    }
}
