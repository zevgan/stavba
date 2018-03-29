<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetailPlatby */

$this->title = Yii::t('app', 'Přidat Detail Platby');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detaily Platby'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-platby-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
