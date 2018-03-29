<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ZpusobyPlatby */

$this->title = Yii::t('app', 'Přidat Způsob Platby');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Způsoby Platby'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zpusoby-platby-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
