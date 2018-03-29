<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ZpusobyPlatby */

$this->title = Yii::t('app', 'Upravit Způsob Platby: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Způsoby Platby'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Upravit');
?>
<div class="zpusoby-platby-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
