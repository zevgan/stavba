<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Faktury */
/* @var $form yii\widgets\ActiveForm */
use kartik\widgets\Select2;
use app\models\Firmy;
use app\models\ZpusobyPlatby;
use app\models\Platce;
use app\models\DetailPlatby;
use kartik\datecontrol\DateControl;

?>

<div class="faktury-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spolecnost')->widget(Select2::classname(), [
        'data' => Firmy::getFirmyList(),
        'options' => ['placeholder' => 'Vyberte firmu...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'datum_zp')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'datum_platby')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'zpusob_platby')->widget(Select2::classname(), [
        'data' => ZpusobyPlatby::getZpusobyPlatbyList(),
        'options' => ['placeholder' => 'Vyberte způsob platby...'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]); ?>

    <?= $form->field($model, 'platce')->widget(Select2::classname(), [
        'data' => Platce::getPlatceList(),
        'options' => ['placeholder' => 'Vyberte plátce...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'detaily_ids')->widget(Select2::classname(), [
        'data' => DetailPlatby::getDetailPlatbyList(),
        'options' => ['placeholder' => 'Vyberte detail platby...'],
        'pluginOptions' => [
            'allowClear' => true,
          'multiple'=>'true'
        ],
    ]); ?>

    <?= $form->field($model, 'bez_dph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dph')->textInput(['maxlength' => true]) ?>

    <? //$form->field($model, 'vc_dph')->textInput(['maxlength' => true])
    ?>

    <?= $form->field($model, 'poznamka')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Uložit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
