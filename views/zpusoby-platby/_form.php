<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ZpusobyPlatby */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zpusoby-platby-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazev_zpusob')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Uložit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
