<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPlatby */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-platby-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazev_platby')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Uložit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
