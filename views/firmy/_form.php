<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Firmy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="firmy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazev_firmy')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Uložit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
