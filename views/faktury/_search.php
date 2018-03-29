<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FakturySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faktury-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'spolecnost') ?>

    <?= $form->field($model, 'datum_zp') ?>

    <?= $form->field($model, 'datum_platby') ?>

    <?= $form->field($model, 'zpusob_platby') ?>

    <?php // echo $form->field($model, 'platce') ?>

    <?php // echo $form->field($model, 'detail_platby') ?>

    <?php // echo $form->field($model, 'bez_dph') ?>

    <?php // echo $form->field($model, 'dph') ?>

    <?php // echo $form->field($model, 'vc_dph') ?>

    <?php // echo $form->field($model, 'poznamka') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
